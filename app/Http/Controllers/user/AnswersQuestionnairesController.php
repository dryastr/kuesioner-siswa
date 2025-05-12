<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Questionnaire;
use App\Models\UserAnswer;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersQuestionnairesController extends Controller
{
    /**
     * Display the questionnaire for the user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $questions = Questionnaire::with('category')->get();

        return view('user.questionnaire.index', compact('questions'));
    }

    /**
     * Store the user's answers.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*.questionnaire_id' => 'required|exists:questionnaires,id',
            'answers.*.answer' => 'required|integer|min:1|max:6',
        ]);

        $userId = Auth::id();

        $currentAttempt = UserAnswer::where('user_id', $userId)->max('attempt') ?? 0;
        $newAttempt = $currentAttempt + 1;

        foreach ($validated['answers'] as $answer) {
            $questionnaire = Questionnaire::find($answer['questionnaire_id']);

            UserAnswer::create([
                'user_id' => $userId,
                'questionnaire_id' => $answer['questionnaire_id'],
                'question' => $questionnaire->question,
                'answer' => $answer['answer'],
                'attempt' => $newAttempt,
            ]);
        }

        $totalScore = UserAnswer::where('user_id', $userId)
            ->where('attempt', $newAttempt)
            ->sum('answer');

        $category = '';
        if ($totalScore <= 50) {
            $category = 'Tidak Kecanduan';
        } elseif ($totalScore <= 100) {
            $category = 'Kecanduan Sedang';
        } else {
            $category = 'Kecanduan Tinggi';
        }

        Result::create([
            'user_id' => $userId,
            'total_score' => $totalScore,
            'category' => $category,
            'attempt' => $newAttempt,
        ]);

        return redirect()->route('questionnaire.index')->with('success', 'Jawaban Anda berhasil disimpan dan hasil telah diperbarui.');
    }
}
