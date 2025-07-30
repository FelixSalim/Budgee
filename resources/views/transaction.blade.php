@extends('layout.template')
@section('title', 'Transactions')
@section('extra-css')
    <link rel="stylesheet" href="/assets/css/transaction.css">
@endsection
@section('content')
<div class="container p-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title m-0 p-0">Transaction</h2>
        <a href="{{ route('newtransaction') }}">
            <button class="add-btn rounded-3">+ Add Transaction</button>
        </a>
    </div>

    {{-- Toggle between Expenses and Incomes --}}
    <div class="d-flex mb-4">
        <a href="{{ route('transactions', ['type' => 'expense', 'month' => $selectedMonthYear]) }}"
           class="toggle-btn w-50 fw-medium {{ $type === 'expense' ? '' : 'secondary' }}">
           Expenses
        </a>
        <a href="{{ route('transactions', ['type' => 'income', 'month' => $selectedMonthYear]) }}"
           class="toggle-btn w-50 fw-medium {{ $type === 'income' ? '' : 'secondary' }}">
           Incomes
        </a>
    </div>

    <div class="row mt-4 mx-0 mb-0 p-4 transaction-history-container">
        <div class="d-flex flex-row justify-content-between align-items-center mb-3 p-0">
            <h2 class="transaction-history-title h2 my-2 mx-0 p-0">Transaction</h2>
            <p class="transaction-history-date p-0 m-0">{{ $months[$selectedMonthYear] ?? 'All' }}</p>
            <div class="dropdown">
                <button class="btn dropdown-toggle month-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $months[$selectedMonthYear] ?? 'All' }}
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('transactions', ['type' => $type]) }}">
                            All
                        </a>
                    </li>
                    @foreach($months as $num => $name)
                        <li>
                            <a class="dropdown-item" href="{{ route('transactions', ['type' => $type, 'month' => $num]) }}">
                                {{ $name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Total --}}
        <p class="mx-0 my-2 p-0 total">
            Total: {{ Auth::user()->currency }} {{ number_format($total, 2) }}
        </p>

        {{-- Table --}}
        <table class="table table-hover mt-3">
            <thead class="table-head">
                <tr>
                    <th scope="col">Categories</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td class="py-3">
                            <div class="row d-flex align-items-center m-0 p-0">
                                <div class="col-3 d-flex justify-content-center align-items-center me-2 icon-container" style="background-color: {{ $transaction->category->icon_color }}">
                                    <img width="20" height="20" src="{{ asset('assets/images/' . str_replace('.png', 'bw.png', $transaction->category->icon)) }}" alt="{{ $transaction->category->name }}" class="m-0 p-0 icon-white">
                                </div>
                                <div class="col m-0 p-0">
                                    <p class="m-0 p-0">{{ $transaction->category->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td>{{ $transaction->description }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-y') }}</td>
                        <td class="{{ $transaction->type === 'expense' ? 'amount-decrease' : 'amount-increase' }}">
                            {{ $transaction->type === 'expense' ? '-' : '+' }}{{ Auth::user()->currency }} {{ number_format($transaction->amount, 0) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No transactions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
