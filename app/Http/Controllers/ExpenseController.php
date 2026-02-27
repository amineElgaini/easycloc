<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(\App\Models\Colocation $colocation)
    {
        if ($colocation->status === 'cancelled') {
            return redirect()->route('colocations.show', $colocation->id)->with('error', 'Cannot add expenses to a cancelled colocation.');
        }
        $categories = $colocation->categories;
        return view('depenses.create', compact('colocation', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'colocation_id' => 'required|exists:colocations,id',
            'category_id'   => 'required|exists:categories,id',
            'title'         => 'required|string|max:255',
            'amount'        => 'required|numeric|min:0.01',
            'expense_date'  => 'required|date',
        ]);

        $validated['paid_by'] = auth()->id();

        // Check if colocation is active
        $colocation = \App\Models\Colocation::findOrFail($validated['colocation_id']);
        if ($colocation->status === 'cancelled') {
            return back()->with('error', 'Cannot add expenses to a cancelled colocation.');
        }

        $expense = \App\Models\Expense::create($validated);
        $members = $colocation->members;
        $memberCount = $members->count();

        if ($memberCount > 0) {
            $shareAmount = round($expense->amount / $memberCount, 2);
            
            foreach ($members as $member) {
                \App\Models\ExpenseShare::create([
                    'expense_id'   => $expense->id,
                    'user_id'      => $member->id,
                    'share_amount' => $shareAmount,
                    'is_payed'     => $member->id === auth()->id(), // Payer's share is already "paid"
                ]);
            }
        }

        return redirect()->route('colocations.show', $expense->colocation_id)
            ->with('success', 'Expense created and split successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
