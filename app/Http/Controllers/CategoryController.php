<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Colocation;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'colocation_id' => 'required|exists:colocations,id',
            'name'          => 'required|string|max:255',
        ]);

        $colocation = Colocation::findOrFail($validated['colocation_id']);

        if ($colocation->owner_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $category = Category::create($validated);

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
        $category = Category::findOrFail($id);

        if ($category->colocation->owner_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($category->expenses()->exists()) {
            return response()->json(['error' => 'Cannot delete category with existing expenses.'], 422);
        }

        $category->delete();

        return response()->json(['success' => true]);
    }
}
