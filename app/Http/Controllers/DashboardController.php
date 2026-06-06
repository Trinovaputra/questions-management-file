<?php

namespace App\Http\Controllers;

use App\Models\Materi;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalMateri = Materi::count();
        $latestMateri = Materi::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalMateri',
            'latestMateri'
        ));
    }

    public function siswa()
    {
        $materis = Materi::latest()->get();
        $totalMateri = Materi::count();
        $materiTerbaru = Materi::latest()->take(3)->get();

        return view('siswa.dashboard', compact(
            'materis',
            'totalMateri',
            'materiTerbaru'
        ));
    }
}
