<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Transaction;

class TransactionController extends Controller
{
    // Store a new transaction
    public function storeTransaction(Request $request)
    {
         $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date|before_or_equal:today'
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
            'description' => $request->description,
            'type' => $request->type
        ]);

        return redirect()->route('home')->with('success', 'Transaction added successfully!');
    }

    public function show(Transaction $transaction){
        return view('transactiondetail', compact('transaction'));
    }

    public function edit(Transaction $transaction){

        $expenseCategories = Category::where('user_id', Auth::id())
            ->where('type', 'expense') // only same type categories
            ->get();

        $incomeCategories = Category::where('user_id', Auth::id())
            ->where('type', 'income') // only same type categories
            ->get();

        return view('edittransaction', compact('transaction', 'expenseCategories', 'incomeCategories'));
    }

    public function update(Request $request, Transaction $transaction){

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string|max:255',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
        ]);

        $transaction->update($validated);
        return redirect()->route('transaction.show', $transaction)->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction){
        $transaction->delete();
        return redirect()->route('transactions')->with('success', 'Transaction deleted successfully.');
    }
}
