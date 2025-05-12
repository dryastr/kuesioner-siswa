<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use App\Models\CategoryQuestionnaire;
use Illuminate\Http\Request;

class QuestionnairesController extends Controller
{
    public function index()
    {
        $questionnaires = Questionnaire::with('category')->get();
        $categories = CategoryQuestionnaire::all();

        return view('admin.questionnaires.index', compact('questionnaires', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:category_questionnaires,id',
            'question' => 'required|string',
        ]);

        Questionnaire::create($validated);

        return redirect()->route('questionnaires.index')->with('success', 'Questionnaire added successfully.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:category_questionnaires,id',
            'question' => 'required|string',
        ]);

        $questionnaire = Questionnaire::findOrFail($id);

        $questionnaire->update($validated);

        return redirect()->route('questionnaires.index')->with('success', 'Questionnaire updated successfully.');
    }

    public function destroy($id)
    {
        $questionnaire = Questionnaire::findOrFail($id);
        $questionnaire->delete();

        return redirect()->route('questionnaires.index')->with('success', 'Questionnaire deleted successfully.');
    }

    public function deleteAll()
    {
        Questionnaire::truncate();

        return redirect()->route('questionnaire.index')->with('success', 'Semua data kuesioner telah dihapus!');
    }
}
