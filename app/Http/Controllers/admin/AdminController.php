<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Result;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalSiswa = User::whereHas('role', function ($query) {
            $query->where('name', 'user'); 
        })->count();

        $siswaMengisiKuesioner = Result::distinct('user_id')->count('user_id');

        $rataRataNilai = Result::avg('total_score');

        $kategoriSiswa = Result::select('category', \DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();

        return view('admin.dashboard', compact('totalSiswa', 'siswaMengisiKuesioner', 'rataRataNilai', 'kategoriSiswa'));
    }
}
