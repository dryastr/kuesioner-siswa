<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAnswer;
use App\Models\Result;
use Illuminate\Http\Request;

class ShowAnswerController extends Controller
{
    
    public function index()
    {
        $students = User::has('userAnswers')->get();
        return view('admin.show_answers.index', compact('students'));
    }


    public function showAttempts($userId)
    {
        $user = User::findOrFail($userId);
        $attempts = Result::where('user_id', $userId)->get();
        return view('admin.show_answers.attempts', compact('user', 'attempts'));
    }


    public function showAnswers($userId, $attempt)
    {
        $user = User::findOrFail($userId);
        $answers = UserAnswer::where('user_id', $userId)
            ->where('attempt', $attempt)
            ->with('questionnaire')
            ->get();

        $result = Result::where('user_id', $userId)
            ->where('attempt', $attempt)
            ->first();

        return view('admin.show_answers.answers', compact('user', 'answers', 'result', 'attempt'));
    }
}
