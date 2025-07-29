<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; // Import the Rule class

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
        $user = Auth::user();
        $expenses = $user->categories()->where('type', 'expense')->get();
        $income = $user->categories()->where('type', 'income')->get();

        return view('transaction', compact('expenses', 'income'));
    }

    public function newtransaction()
    {
        // Logic for the new transaction page
        return view('newtransaction');
    }

    public function categories()
    {
        $user = Auth::user();
        $expenses = $user->categories()->where('type', 'expense')->get();
        $income = $user->categories()->where('type', 'income')->get();

        return view('categories', compact('expenses', 'income'));
    }

    public function storeCategory(Request $request)
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Validate the input with added rules
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                // Ensure the category name is unique for the current user
                Rule::unique('categories')->where(function ($query) use ($userId) {
                    return $query->where('user_id', $userId);
                }),
            ],
            'type' => 'required|in:income,expense',
            'planned_outlay' => 'required|numeric|min:0', // Must be numeric and non-negative
            'icon' => 'required|string', // Icon must be selected
            'icon_color' => 'required|string', // Color must be selected
        ], [
            // Custom error messages
            'name.required' => 'Category name is required.',
            'name.unique' => 'You already have a category with this name.',
            'planned_outlay.required' => 'Planned outlay is required.',
            'planned_outlay.numeric' => 'Planned outlay must be a number.',
            'planned_outlay.min' => 'Planned outlay cannot be negative.',
            'icon.required' => 'Please select an icon for the category.',
            'icon_color.required' => 'Please select a color for the category.',
        ]);

        // Create the category for the authenticated user
        Auth::user()->categories()->create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'planned_outlay' => $validated['planned_outlay'],
            'icon' => $validated['icon'],
            'icon_color' => $validated['icon_color'],
        ]);

        return redirect()->route('categories')->with('success', 'Category added successfully!');
    }


    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        // Only allow deleting categories belonging to the authenticated user
        if ($category->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        $category->delete();

        return redirect()->route('categories')->with('success', 'Category deleted successfully.');
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

}
