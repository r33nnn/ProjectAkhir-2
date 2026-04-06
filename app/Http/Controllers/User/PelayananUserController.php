<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pelayanan;

class PelayananUserController extends Controller
{
    public function index()
    {
        $pelayanans = Pelayanan::all();
        return view('User.Pelayanan.Pelayanan', compact('pelayanans'));
    }
}
