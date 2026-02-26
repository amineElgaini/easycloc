<?php

namespace App\Http\Controllers;

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
}
