<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Goal;
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
                $category = $transactions->first()->category;
                return [
                    'name' => $categoryName,
                    'color' => $category->icon_color ?? '#ccc',
                    'total' => $transactions->sum('amount'),
                    'planned_outlay' => $category->planned_outlay ?? 0,
                    'icon' => str_replace('.png', 'bw.png', $category->icon),
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
                $category = $transactions->first()->category;
                return [
                    'name' => $categoryName,
                    'color' => $category->icon_color ?? '#ccc',
                    'total' => $transactions->sum('amount'),
                    'planned_outlay' => $category->planned_outlay ?? 0,
                    'icon' => str_replace('.png', 'bw.png', $category->icon),
                ];
            })
            ->values();

        return view('dashboard', compact(
            'months',
            'selectedMonthYear',
            'totalIncome',
            'totalExpense',
            'balance',
            'recentTransactions',
            'expenseData',
            'incomeData'
        ));
    }

    public function transactions(Request $request)
    {
        $type = $request->get('type', 'expense'); // default expenses
        $selectedMonthYear = $request->input('month', 'all'); // default to "all"

        $query = Transaction::with('category')
            ->where('user_id', auth()->id())
            ->where('type', $type);

        if ($selectedMonthYear !== 'all') {
            $parts = explode('-', $selectedMonthYear); // e.g. 2025-06
            $query->whereYear('transaction_date', $parts[0])
                ->whereMonth('transaction_date', $parts[1]);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->get();
        $total = $transactions->sum('amount');

        // Generate month list
        $months = Transaction::selectRaw("DATE_FORMAT(transaction_date, '%Y-%m') as ym")
            ->where('user_id', auth()->id())
            ->distinct()
            ->orderBy('ym', 'desc')
            ->get()
            ->pluck('ym')
            ->mapWithKeys(function ($ym) {
                $date = \Carbon\Carbon::createFromFormat('Y-m', $ym);
                return [$ym => $date->format('F Y')];
            })
            ->toArray();

        return view('transaction', compact('transactions', 'total', 'months', 'selectedMonthYear', 'type'));
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
        $goals = Goal::where('user_id', Auth::id())->get();
        $totalSaved = $goals->sum('current_amount');
        return view('goalslist', compact('goals', 'totalSaved'));
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
