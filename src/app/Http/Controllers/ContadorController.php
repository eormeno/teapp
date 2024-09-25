<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContadorController extends Controller
{
    public function index()
    {
        $número = 200;
        return view('contador', compact('número'));
    }

    public function incrementar($número)
    {
        $número++;
        return view('contador', compact('número'));
    }

    public function decrementar($número)
    {
        $número--;
        return view('contador', compact('número'));
    }
}
