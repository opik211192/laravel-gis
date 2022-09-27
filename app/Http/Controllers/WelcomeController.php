<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function detail(Wilayah $wilayah)
    {
        return view('detail', compact('wilayah'));
    }
}
