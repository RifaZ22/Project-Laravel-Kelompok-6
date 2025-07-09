<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Contoh data dummy (nanti bisa kamu ambil dari database jika diperlukan)
        $userPoints = 250; // total poin user
        $userLevel = 'Silver';
        $levelProgress = 65; // persen ke level berikutnya
        $pointsToNextLevel = 350;

        $pointHistory = [
            [
                'type' => 'earned',
                'description' => 'Pembelian sepatu Nike',
                'points' => 100,
                'date' => '2025-07-01',
            ],
            [
                'type' => 'spent',
                'description' => 'Tukar diskon 10%',
                'points' => 100,
                'date' => '2025-07-03',
            ],
            [
                'type' => 'earned',
                'description' => 'Bonus Member Baru',
                'points' => 250,
                'date' => '2025-07-05',
            ],
        ];

        return view('reward.index', compact(
            'userPoints',
            'userLevel',
            'levelProgress',
            'pointsToNextLevel',
            'pointHistory'
        ));
    }
}
