<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\ExpenseShare;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $current = $user->colocations()
            ->wherePivotNull('left_at')
            ->where('status', 'active')
            ->with('owner')
            ->withCount('members')
            ->get();

        $previous = $user->colocations()
            ->wherePivotNull('left_at')
            ->where('status', 'cancelled')
            ->with('owner')
            ->withCount('members')
            ->get();

        return view('colocations.index', compact('current', 'previous'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('colocations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image'    => 'required|image|max:2048',
        ]);

        if (!auth()->user()->is_admin) {
            $alreadyInColocation = auth()->user()
                ->colocations()
                ->where('status', 'active')
                ->exists();

            if ($alreadyInColocation) {
                return back()
                    ->withErrors(['colocation' => 'You are already a member of an active colocation. You must leave or cancel it before creating a new one.'])
                    ->withInput();
            }
        }

        $validated['image']    = $request->file('image')->store('colocations', 'public');
        $validated['owner_id'] = auth()->id();

        $colocation = Colocation::create($validated);

        $colocation->members()->attach(auth()->id());

        return redirect()->route('colocations.index')
            ->with('success', 'Colocation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $selectedMonth = $request->get('month');

        $colocation = Colocation::with([
            'owner',
            'members' => function ($query) {
                $query->wherePivotNull('left_at');
            },
            'categories',
            'invitations'
        ])->findOrFail($id);

        // Get unique months with expenses for this colocation
        $availableMonths = DB::table('expenses')
            ->where('colocation_id', $id)
            ->select(DB::raw('DISTINCT DATE_FORMAT(expense_date, "%Y-%m") as month'))
            ->orderBy('month', 'desc')
            ->pluck('month');

        $expensesQuery = $colocation->expenses()
            ->with(['payer', 'category', 'shares'])
            ->latest('expense_date');

        if ($selectedMonth) {
            $expensesQuery->whereRaw('DATE_FORMAT(expense_date, "%Y-%m") = ?', [$selectedMonth]);
        }

        $filteredExpenses = $expensesQuery->get();

        // Check if user is a member (has not left) or is the owner
        $isMember = $colocation->members()->where('users.id', auth()->id())->wherePivotNull('left_at')->exists();
        $isOwner = auth()->id() === $colocation->owner_id;

        if (!$isMember && !$isOwner) {
            abort(403, 'You are not a member of this colocation.');
        }

        $totalExpenses = $filteredExpenses->sum('amount');
        $membersCount = $colocation->members->count();

        $userOwes = ExpenseShare::where('user_id', auth()->id())
            ->whereIn('expense_id', $filteredExpenses->pluck('id'))
            ->where('is_payed', false)
            ->sum('share_amount');

        return view('colocations.show', compact(
            'colocation', 
            'totalExpenses', 
            'membersCount', 
            'userOwes', 
            'filteredExpenses', 
            'availableMonths',
            'selectedMonth'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function inviteMember(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $colocation = Colocation::findOrFail($id);

        if ($colocation->status === 'cancelled') {
            return response()->json(['message' => 'Cannot invite members to a cancelled colocation.'], 403);
        }

        if ($colocation->members()->where('email', $request->email)->exists()) {
            return response()->json(['message' => 'User is already a member of this colocation.'], 422);
        }

        $invitation = \App\Models\Invitation::create([
            'colocation_id' => $colocation->id,
            'email' => $request->email,
            'token' => \Illuminate\Support\Str::random(32),
            'expires_at' => now()->addDays(7),
        ]);

        \Illuminate\Support\Facades\Mail::to($request->email)->send(new \App\Mail\InvitationMail($colocation, $invitation));

        return response()->json(['message' => 'Invitation sent successfully!']);
    }

    public function debts($id)
    {
        $colocation = Colocation::with([
            'owner', 
            'members' => function($query) {
                $query->wherePivotNull('left_at');
            }, 
            'expenses.shares.user', 
            'expenses.payer'
        ])->findOrFail($id);
        
        $isMember = $colocation->members()->where('users.id', auth()->id())->wherePivotNull('left_at')->exists();
        $isOwner = auth()->id() === $colocation->owner_id;

        if (!$isMember && !$isOwner) {
            abort(403, 'You are not a member of this colocation.');
        }

        $allShares = $colocation->expenses->flatMap->shares;
        
        $meaningfulShares = $allShares->filter(function($share) {
            return $share->user_id !== $share->expense->paid_by;
        });

        $unpaidShares = $meaningfulShares->where('is_payed', false);
        $totalOutstanding = $unpaidShares->sum('share_amount');
        $pendingSettlementsCount = $unpaidShares->count();
        $distinctUsersOwing = $unpaidShares->pluck('user_id')->unique()->count();

        $userOwes = ExpenseShare::where('user_id', auth()->id())
            ->whereIn('expense_id', $colocation->expenses->pluck('id'))
            ->where('is_payed', false)
            ->sum('share_amount');

        return view('colocations.depenseDetail', compact(
            'colocation', 
            'userOwes', 
            'meaningfulShares', 
            'totalOutstanding', 
            'pendingSettlementsCount', 
            'distinctUsersOwing'
        ));
    }

    public function settleShare($shareId)
    {
        $share = ExpenseShare::with('expense.colocation')->findOrFail($shareId);
        
        if ($share->expense->colocation->status === 'cancelled') {
            return back()->with('error', 'Cannot settle debts in a cancelled colocation.');
        }

        if (auth()->id() !== $share->expense->colocation->owner_id) {
            return back()->with('error', 'Only the colocation owner can settle debts.');
        }

        $share->update(['is_payed' => true]);

        return back()->with('success', 'Debt settled successfully.');
    }

    public function leave(Colocation $colocation)
    {
        $userId = auth()->id();
        $user = auth()->user();

        if ($colocation->owner_id === $userId) {
            return back()->with('error', 'As the owner can\'t leave the colocation');
        }

        if ($colocation->status === 'cancelled') {
            return back()->with('error', 'Cannot leave a cancelled colocation.');
        }

        $membership = Membership::where('colocation_id', $colocation->id)
            ->where('user_id', $userId)
            ->whereNull('left_at')
            ->firstOrFail();

        DB::transaction(function () use ($colocation, $user, $membership) {
            $unpaidShares = ExpenseShare::where('user_id', $user->id)
                ->where('is_payed', false)
                ->whereHas('expense', function ($query) use ($colocation) {
                    $query->where('colocation_id', $colocation->id);
                })
                ->get();

            // Reputation adjustment
            if ($unpaidShares->isEmpty()) {
                $user->increment('reputation');
            } else {
                $user->decrement('reputation');
            }

            foreach ($unpaidShares as $share) {
                $expense = $share->expense;
                
                $otherShares = ExpenseShare::where('expense_id', $expense->id)
                    ->where('user_id', '!=', $user->id)
                    ->get();

                if ($otherShares->count() > 0) {
                    $redistributionAmount = round($share->share_amount / $otherShares->count(), 2);
                    
                    foreach ($otherShares as $otherShare) {
                        $otherShare->increment('share_amount', $redistributionAmount);
                    }
                }

                $share->delete();
            }

            $membership->update(['left_at' => now()]);
        });

        return redirect()->route('colocations.index')->with('success', 'You have left the colocation. Your remaining debts have been redistributed among other members.');
    }

    public function kick(Colocation $colocation, \App\Models\User $user)
    {
        $ownerId = auth()->id();

        if ($colocation->status === 'cancelled') {
            return back()->with('error', 'Cannot kick members from a cancelled colocation.');
        }

        if ($colocation->owner_id !== $ownerId) {
            return back()->with('error', 'Only the owner can kick members.');
        }

        if ($user->id === $ownerId) {
            return back()->with('error', 'You cannot kick yourself.');
        }

        $membership = Membership::where('colocation_id', $colocation->id)
            ->where('user_id', $user->id)
            ->whereNull('left_at')
            ->firstOrFail();

        DB::transaction(function () use ($colocation, $user, $ownerId, $membership) {
            $unpaidShares = ExpenseShare::where('user_id', $user->id)
                ->where('is_payed', false)
                ->whereHas('expense', function ($query) use ($colocation) {
                    $query->where('colocation_id', $colocation->id);
                })
                ->get();

            // Reputation adjustment
            if ($unpaidShares->isEmpty()) {
                $user->increment('reputation');
            } else {
                $user->decrement('reputation');
            }

            foreach ($unpaidShares as $share) {
                $ownerShare = ExpenseShare::firstOrCreate(
                    ['expense_id' => $share->expense_id, 'user_id' => $ownerId],
                    ['share_amount' => 0, 'is_payed' => true]
                );

                $ownerShare->increment('share_amount', $share->share_amount);
                $share->delete();
            }

            // Mark membership as left
            $membership->update(['left_at' => now()]);
        });

        return back()->with('success', "{$user->name} has been kicked. Their unpaid debts were transferred to you.");
    }

    public function transferOwnership(Colocation $colocation, \App\Models\User $user)
    {
        $currentOwnerId = auth()->id();

        if ($colocation->status === 'cancelled') {
            return back()->with('error', 'Cannot transfer ownership of a cancelled colocation.');
        }

        // Authorization: Only owner or admin
        if ($colocation->owner_id !== $currentOwnerId && !auth()->user()->isAdmin()) {
            return back()->with('error', 'Unauthorized action.');
        }

        // Validate target user is a member
        $isMember = $colocation->members()
            ->where('users.id', $user->id)
            ->wherePivotNull('left_at')
            ->exists();

        if (!$isMember) {
            return back()->with('error', 'The target user must be an active member of the colocation.');
        }

        $colocation->update(['owner_id' => $user->id]);

        return back()->with('success', "Ownership successfully transferred to {$user->name}.");
    }

    public function cancel(Colocation $colocation)
    {
        if (auth()->id() !== $colocation->owner_id) {
            abort(403, 'Only the owner can cancel the colocation.');
        }

        if ($colocation->status === 'cancelled') {
            return back()->with('error', 'Colocation is already cancelled.');
        }

        $colocation->update(['status' => 'cancelled']);

        return redirect()->route('colocations.index')->with('success', 'Colocation has been cancelled successfully.');
    }
}
