@extends('layout.template')
@section('title', 'Transaction Detail')
@section('extra-css')
    <link rel="stylesheet" href="{{ asset('assets/css/transactiondetail.css') }}">
@endsection
@section('content')
<div class="container py-5">
    <h2 class="mb-4">Transaction Detail</h2>

    <div class="card p-4">
        <div class="d-flex align-items-center mb-3">
            <div class="icon-container me-3" style="background-color: {{ $transaction->category->icon_color }}">
                <img src="/assets/images/{{ str_replace('.png', 'bw.png', $transaction->category->icon) }}" class="white-icon" width="30" height="30">
            </div>
            <h4 class="mb-0">{{ $transaction->category->name }}</h4>
        </div>

        <p><strong>Amount:</strong> {{ Auth::user()->currency }} {{ number_format($transaction->amount, 2) }}</p>
        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</p>
        <p><strong>Type:</strong> {{ ucfirst($transaction->type) }}</p>
        <p><strong>Description:</strong> {{ $transaction->description ?? '-' }}</p>

        <div class="mt-4 d-flex gap-3">
            <a href="{{ route('transaction.edit', $transaction) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('transaction.destroy', $transaction) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
