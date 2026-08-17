<?php

namespace App\Http\Controllers;

use App\Models\Divisi;

abstract class Controller
{
    function index()
    {
        $divisi = Divisi::all();
        return view('divisi.index', compact('divisi'));
    }
}
