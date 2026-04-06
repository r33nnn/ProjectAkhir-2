<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Khotbah;

class KhotbahUserController extends Controller
{
    public function index()
    {
        $khotbahs = Khotbah::all();
        return view('User.Khotbah.Khotbah', compact('khotbahs'));
    }
}
