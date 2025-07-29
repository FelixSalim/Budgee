<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegularPayment;
use Illuminate\Support\Facades\Auth;

class RegularPaymentController extends Controller
{
    public function index()
    {
        $regularPayments = RegularPayment::where('user_id', Auth::id())->get();
        return view('regularpayment', compact('regularPayments'));
    }

    public function create()
    {
        return view('newregularpayment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|integer|between:1,31',
        ]);

        RegularPayment::create([
            'user_id' => Auth::id(),
            'name' => $request->input('transaction'),
            'amount' => $request->input('amount'),
            'due_date' => $request->input('due_date'),
            'status' => 'unpaid', // or other default
            'icon' => 'music-note-beamed.svg', // optional, adjust if dynamic
            'icon_color' => '#000000', // optional, adjust if dynamic
        ]);

        return redirect()->route('regularpayment')->with('success', 'Regular payment added.');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:paid,unpaid',
            'amount' => 'required|numeric',
            'due_date' => 'required|integer|between:1,31',
        ]);

        $payment = RegularPayment::where('user_id', Auth::id())->findOrFail($id);
        
        $payment->update([
            'status' => $validated['status'],
            'amount' => $validated['amount'],
            'due_date' => $validated['due_date'],
        ]);

        return response()->json(['success' => true]);
    }
}
