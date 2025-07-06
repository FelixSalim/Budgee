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

    public function newtransaction()
    {
        // Logic for the new transaction page
        return view('newtransaction');
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
    public function regularpayment()
    {
        // Logic for the categories page
        return view('regularpayment');
    }
    public function newregularpayment()
    {
        // Logic for the categories page
        return view('newregularpayment');
    }
    public function profile()
    {
        return view('profile');
    }
    public function login()
    {
        return view('log-in');
    }
    public function goalslist()
    {
        return view('goalslist');
    }
    public function newgoals()
    {
        return view('newgoals');
    }
}
