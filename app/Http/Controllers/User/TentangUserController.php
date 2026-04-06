<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tentang;

class TentangUserController extends Controller
{
    public function index()
    {
        $tentang = Tentang::first();
        $gereja = [
            'tahun_berdiri' => $tentang->tahun_berdiri ?? '1970',
        ];

        return view('User.Tentang.TentangKami', compact('tentang', 'gereja'));
    }
}
