<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|confirmed|min:6',
            'currency' => 'nullable|string',
            'agree' => 'required',

        ]);

        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'currency' => $request->currency ?? 'IDR',
            'balance' => 0,
            'profile_picture' => null, // default profile picture can be set later
        ]);

        // login otomatis setelah register
        // Auth::login($user);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');

    }

    public function login(Request $request) {
        $credentials = $request->only('username', 'password');

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->with('error', 'Invalid username or password');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email',
            'username' => 'required|string',
            'currency' => 'required|string',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->email = $request->email;
        $user->username = $request->username;
        $user->currency = $request->currency;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function updateProfilePicture(Request $request) {
        $user = auth()->user();

        // Ensure the storage link is created
        if (!file_exists(public_path('storage'))) {
            Artisan::call('storage:link');
        }


        if($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_picture', 'public');

            $user->profile_picture = $path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile picture updated!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
