@extends('layout.template')
@section('title', 'Edit Transaction')
@section('content')
<div class="container py-5">
    <h2 class="mb-4">Edit Transaction</h2>

    <form action="{{ route('transaction.update', $transaction) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Amount</label>
            <input type="number" step="0.01" name="amount" class="form-control" value="{{ $transaction->amount }}" required>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="transaction_date" class="form-control" value="{{ $transaction->transaction_date }}" max="{{ now()->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control">
                <option value="expense" {{ $transaction->type == 'expense' ? 'selected' : '' }}>Expense</option>
                <option value="income" {{ $transaction->type == 'income' ? 'selected' : '' }}>Income</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $transaction->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="{{ $transaction->description }}">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('transaction.show', $transaction) }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
