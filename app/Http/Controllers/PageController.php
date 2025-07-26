<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //

    public function index()
    {
        // Logic for the home page
        return view('dashboard');
    }

    public function transactions()
    {
        // Logic for the transactions page
        return view('transaction');
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
        $user = Auth::user();
        return view('profile', compact('user'));
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
    public function register()
    {
        return view('register');
    }

    public function updateProfile(Request $request) {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|unique:users,username,' . $user->id,
            'currency' => 'required',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // update data
        $user->email = $request->email;
        $user->username = $request->username;
        $user->currency = $request->currency;

        // Upload profile picture jika ada
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $imagePath;
        }

        $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
