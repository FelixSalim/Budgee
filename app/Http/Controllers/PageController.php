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

    public function categories()
    {
        // Logic for the categories page
        return view('categories');
    }

    public function newcategory()
    {
        // Logic for the new category page
        return view('newcategory');
    }
}
