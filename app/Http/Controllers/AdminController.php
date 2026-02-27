<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\Membership;
use App\Models\Invitation;

class AdminController extends Controller
{
    public function index()
    {
        
        $totalColocations = Colocation::count();
        $totalExpenses = Expense::count();
        $totalMembers = Membership::whereNull('left_at')->count();
        $activeInvitations = Invitation::where('is_accepted', false)->count();

        return view('dashboard', compact(
            'totalColocations',
            'totalExpenses',
            'totalMembers',
            'activeInvitations'
        ));
    }

    public function users()
    {
        $users = User::where('role', '!=', 'admin')
            ->with(['ownedColocations.members' => function ($query) {
                $query->wherePivotNull('left_at');
            }])
            ->get();
        return view('admin.users.index', compact('users'));
    }

    public function toggleBan(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'You cannot ban an admin.');
        }

        if (!$user->is_banned) {
            $ownsActiveColocation = $user->ownedColocations()->where('status', 'active')->exists();
            if ($ownsActiveColocation) {
                return back()->with('error', 'You cannot ban this user because they are the owner of an active colocation. They must transfer ownership or cancel the colocation first.');
            }
        }

        $user->update([
            'is_banned' => !$user->is_banned,
            'banned_at' => !$user->is_banned ? now() : null,
        ]);

        $status = $user->is_banned ? 'banned' : 'unbanned';
        return back()->with('success', "User has been {$status} successfully.");
    }
}
