<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kontak;

class KontakUserController extends Controller
{
    public function index()
    {
        $kontaks = Kontak::all();
        return view('User.Kontak.kontak', compact('kontaks'));
    }
}
