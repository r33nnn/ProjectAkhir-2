<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;

class JadwalUserController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::where('category', 'mingguan')->get();
        $acaraKhusus = Jadwal::where('category', 'acara_khusus')->get();

        return view('User.Jadwal.Jadwal', compact('jadwals', 'acaraKhusus'));
    }
}
