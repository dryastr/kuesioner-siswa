<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryQuestionnaire as ModelsCategoryQuestionnaire;
use Illuminate\Http\Request;

class CategoryQuestionnaire extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ModelsCategoryQuestionnaire::all();
        return view('admin.category-questionnaires.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ModelsCategoryQuestionnaire::create($request->only('name'));

        return redirect()->back()->with('success', 'Category added successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = ModelsCategoryQuestionnaire::findOrFail($id);
        $category->update($request->only('name'));

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = ModelsCategoryQuestionnaire::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
