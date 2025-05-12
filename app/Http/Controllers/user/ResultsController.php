<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $attempt = $request->input('attempt', 1); 


        $results = Result::where('user_id', $userId)
            ->where('attempt', $attempt)
            ->first();


        $attempts = Result::where('user_id', $userId)->distinct()->pluck('attempt');

        return view('user.results.index', compact('results', 'attempts', 'attempt'));
    }
}
