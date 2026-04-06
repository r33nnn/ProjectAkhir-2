<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Galeri;

class GaleriUserController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('User.Galeri.Galeri', compact('galeris'));
    }
}
