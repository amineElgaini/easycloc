<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'colocation_id' => 'required|exists:colocations,id',
            'name'          => 'required|string|max:255',
        ]);

        $colocation = \App\Models\Colocation::findOrFail($validated['colocation_id']);
        
        // Ensure only owner can add categories
        if ($colocation->owner_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $category = \App\Models\Category::create($validated);

        return response()->json([
            'success'  => true,
            'category' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = \App\Models\Category::findOrFail($id);
        
        // Ensure only owner can delete categories
        if ($category->colocation->owner_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Check if category has expenses
        if ($category->expenses()->exists()) {
            return response()->json(['error' => 'Cannot delete category with existing expenses.'], 422);
        }

        $category->delete();

        return response()->json(['success' => true]);
    }
}
