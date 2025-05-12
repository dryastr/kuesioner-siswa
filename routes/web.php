<?php

use App\Http\Controllers\admin\AddUsersController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryQuestionnaire;
use App\Http\Controllers\admin\QuestionnairesController;
use App\Http\Controllers\admin\ShowAnswerController;
use App\Http\Controllers\User\AnswersQuestionnairesController;
use App\Http\Controllers\user\ResultsController;
use App\Http\Controllers\user\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role->name === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('home');
        }
    }
    return redirect()->route('login');
})->name('home');

Auth::routes(['middleware' => ['redirectIfAuthenticated']]);


Route::middleware(['auth', 'role.admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('category-questionnaires', CategoryQuestionnaire::class);
    Route::resource('questionnaires', QuestionnairesController::class);
    Route::resource('students', AddUsersController::class);
    Route::delete('questionnaires/delete-all', [QuestionnairesController::class, 'deleteAll'])->name('questionnaire.deleteAll');
    Route::get('/show-answers', [ShowAnswerController::class, 'index'])->name('show.answers');
    Route::get('/show-answers/{userId}', [ShowAnswerController::class, 'showAttempts'])->name('show.attempts');
    Route::get('/show-answers/{userId}/attempt/{attempt}', [ShowAnswerController::class, 'showAnswers'])->name('show.answers.detail');
});

Route::middleware(['auth', 'role.user'])->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('home');

    Route::resource('questionnaire', AnswersQuestionnairesController::class);
    Route::get('/results', [ResultsController::class, 'index'])->name('results.index');
});

// Contoh
// Route::get('/', function () {
//     if (Auth::check()) {
//         $user = Auth::user();
//         if ($user->role->name === 'super_admin') {
//             return redirect()->route('super_admin.dashboard');
//         } elseif ($user->role->name === 'admin') {
//             return redirect()->route('admin.dashboard');
//         } elseif ($user->role->name === 'kaprog') {
//             return redirect()->route('kaprog.dashboard');
//         } elseif ($user->role->name === 'pemray') {
//             return redirect()->route('pemray.dashboard');
//         } else {
//             return redirect()->route('home');
//         }
//     }
//     return redirect()->route('login');
// })->name('home');
