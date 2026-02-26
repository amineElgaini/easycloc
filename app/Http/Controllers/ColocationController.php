<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\ExpenseShare;
use Illuminate\Http\Request;

class ColocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $current = $user->colocations()
            ->where('status', 'active')
            ->with('owner')
            ->withCount('members')
            ->get();

        $previous = $user->colocations()
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

        // Check if user is already in an active colocation (unless admin)
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

        // Automatically add the owner as the first member
        $colocation->members()->attach(auth()->id());

        return redirect()->route('colocations.index')
            ->with('success', 'Colocation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $colocation = Colocation::with([
            'owner',
            'members',
            'expenses' => function ($query) {
                $query->with(['payer', 'category', 'shares'])->latest('expense_date');
            },
            'invitations'
        ])->findOrFail($id);

        $totalExpenses = $colocation->expenses->sum('amount');
        $membersCount = $colocation->members->count();

        $userOwes = ExpenseShare::where('user_id', auth()->id())
            ->whereIn('expense_id', $colocation->expenses->pluck('id'))
            ->where('is_payed', false)
            ->sum('share_amount');

        return view('colocations.show', compact('colocation', 'totalExpenses', 'membersCount', 'userOwes'));
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

        // Check if user is already a member
        if ($colocation->members()->where('email', $request->email)->exists()) {
            return response()->json(['message' => 'User is already a member of this colocation.'], 422);
        }

        // Create invitation
        $invitation = \App\Models\Invitation::create([
            'colocation_id' => $colocation->id,
            'email' => $request->email,
            'token' => \Illuminate\Support\Str::random(32),
            'expires_at' => now()->addDays(7),
        ]);

        // Send email
        \Illuminate\Support\Facades\Mail::to($request->email)->send(new \App\Mail\InvitationMail($colocation, $invitation));

        return response()->json(['message' => 'Invitation sent successfully!']);
    }
}
