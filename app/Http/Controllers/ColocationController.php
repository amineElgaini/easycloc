<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
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
