<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //

    public function index()
    {
        // Logic for the home page
        return view('dashboard');
    }
}
