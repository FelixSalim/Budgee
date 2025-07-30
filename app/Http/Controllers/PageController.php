<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule; // Import the Rule class

class PageController extends Controller
{

    public function index(Request $request)
    {
        $userId = Auth::id();

        $selectedMonthYear = $request->input('month', 'all'); // default to "all"

        // Get all months that have at least one transaction
        $months = Transaction::where('user_id', $userId)
            ->selectRaw("DATE_FORMAT(transaction_date, '%Y-%m') as ym, DATE_FORMAT(transaction_date, '%b %Y') as label")
            ->groupBy('ym', 'label')
            ->orderBy('ym', 'desc')
            ->get()
            ->mapWithKeys(function ($row) {
                return [$row->ym => $row->label];
            })
            ->toArray();

        $months = ['all' => 'All Months'] + $months;

        $totalIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income');

        $totalExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense');

        $year = null;
        $month = null;

        if ($selectedMonthYear !== 'all') {
            [$year, $month] = explode('-', $selectedMonthYear);
            $totalIncome->whereYear('transaction_date', $year)->whereMonth('transaction_date', $month);
            $totalExpense->whereYear('transaction_date', $year)->whereMonth('transaction_date', $month);
        }

        $totalIncome = $totalIncome->sum('amount');
        $totalExpense = $totalExpense->sum('amount');

        $balance = $totalIncome - $totalExpense;

        // get recent 3 transactions
        $recentTransactions = Transaction::with('category')
            ->where('user_id', $userId)
            ->when($selectedMonthYear !== 'all', function ($q) use ($year, $month) {
                $q->whereYear('transaction_date', $year)->whereMonth('transaction_date', $month);
            })
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Expenses
        $expenseData = Transaction::with('category')
            ->where('user_id', $userId)
            ->where('type', 'expense')
            ->when($selectedMonthYear !== 'all', function ($query) use ($year, $month) {
                $query->whereYear('transaction_date', $year)
                    ->whereMonth('transaction_date', $month);
            })
            ->get()
            ->groupBy(fn($t) => $t->category->name)
            ->map(function ($transactions, $categoryName) {
                return [
                    'name' => $categoryName,
                    'color' => optional($transactions->first()->category)->icon_color ?? '#ccc',
                    'total' => $transactions->sum('amount'),
                ];
            })
            ->values();

        // Incomes
        $incomeData = Transaction::with('category')
            ->where('user_id', $userId)
            ->where('type', 'income')
            ->when($selectedMonthYear !== 'all', function ($query) use ($year, $month) {
                $query->whereYear('transaction_date', $year)
                    ->whereMonth('transaction_date', $month);
            })
            ->get()
            ->groupBy(fn($t) => $t->category->name)
            ->map(function ($transactions, $categoryName) {
                return [
                    'name' => $categoryName,
                    'color' => optional($transactions->first()->category)->icon_color ?? '#ccc',
                    'total' => $transactions->sum('amount'),
                ];
            })
            ->values();

        $expenseLabels = $expenseData->pluck('name');
        $incomeLabels = $incomeData->pluck('name');
        $expenseColors = $expenseData->pluck('color');
        $incomeColors = $incomeData->pluck('color');
        $expenseAmounts = $expenseData->pluck('total');
        $incomeAmounts = $incomeData->pluck('total');

        return view('dashboard', compact(
            'months', 'selectedMonthYear',
            'totalIncome', 'totalExpense', 'balance', 'recentTransactions',
            'expenseLabels', 'incomeLabels', 'expenseColors', 'incomeColors',
            'expenseAmounts', 'incomeAmounts'
        ));
    }

    public function transactions()
    {
        return view('transaction');
    }

    public function newtransaction()
    {
        $user = Auth::user();
        $expenses = $user->categories()->where('type', 'expense')->get();
        $income = $user->categories()->where('type', 'income')->get();

        return view('newtransaction', compact('expenses', 'income'));
    }

        public function categories()
    {
        $user = Auth::user();
        $expenses = $user->categories()->where('type', 'expense')->get();
        $income = $user->categories()->where('type', 'income')->get();

        return view('categories', compact('expenses', 'income'));
    }

    public function newcategory()
    {
        // Logic for the new category page
        return view('newcategory');
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
            'planned_outlay' => 'required|numeric|min:0', // 'required' to 'nullable' based on placeholder "Not set"
            'icon' => 'required|string', // Icon must be selected
            'icon_color' => 'required|string', // Color must be selected
        ], [
            // Custom error messages
            'name.required' => 'Category name is required.',
            'name.unique' => 'You already have a category with this name.',
            'planned_outlay.required' => 'Planned outlay is required.',
            'planned_outlay.numeric' => 'Planned outlay must be a number.',
            'planned_outlay.min' => 'Planned outlay cannot be negative.',

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

    public function editCategory(Category $category)
    {
        // Ensure the category belongs to the authenticated user
        if ($category->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }
        return view('editcategory', compact('category'));
    }

    public function updateCategory(Request $request, Category $category)
    {
        // Ensure the category belongs to the authenticated user
        if ($category->user_id !== Auth::id()) {
            abort(403); // Forbidden
        }

        $userId = Auth::id();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                // Ensure the category name is unique for the current user, excluding the current category
                Rule::unique('categories')->where(function ($query) use ($userId, $category) {
                    return $query->where('user_id', $userId)->where('id', '!=', $category->id);
                }),
            ],
            'type' => 'required|in:income,expense',
            'planned_outlay' => 'required|numeric|min:0', // Changed from 'nullable' to 'required'
            'icon' => 'required|string',
            'icon_color' => 'required|string',
        ], [
            'name.required' => 'Category name is required.',
            'name.unique' => 'You already have a category with this name.',
            'planned_outlay.required' => 'Planned outlay is required.', // Added specific message
            'planned_outlay.numeric' => 'Planned outlay must be a number.',
            'planned_outlay.min' => 'Planned outlay cannot be negative.',
            'icon.required' => 'Please select an icon for the category.',
            'icon_color.required' => 'Please select a color for the category.',
        ]);

        // Remove this line as 'planned_outlay' is now required
        // $validated['planned_outlay'] = $validated['planned_outlay'] ?? 0.00;

        $category->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'planned_outlay' => $validated['planned_outlay'],
            'icon' => $validated['icon'],
            'icon_color' => $validated['icon_color'],
        ]);

        return redirect()->route('categories')->with('success', 'Category updated successfully!');
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
