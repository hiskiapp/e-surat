<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Letter;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $letters = Letter::all();
        return view('home', ['letters' => $letters]);
    }
}
