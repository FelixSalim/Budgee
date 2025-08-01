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
            <select name="category_id" class="form-control" id="categorySelect" required>
                
            </select>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" class="form-control" value="{{ $transaction->description }}">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn" style="background-color: #005CAB; color: white;">Save Changes</button>
            <a href="{{ route('transaction.show', $transaction) }}" class="btn" style="background-color: #6c757d; color: white;">Cancel</a>
        </div>
    </form>
</div>
@endsection
@section('extra-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.querySelector('select[name="type"]');
        const categorySelect = document.getElementById('categorySelect');

        const expenseCategories = @json($expenseCategories);
        const incomeCategories = @json($incomeCategories);

        function updateCategories(type) {
            categorySelect.innerHTML = '';
            const list = type === 'income' ? incomeCategories : expenseCategories;

            list.forEach(cat => {
                const option = document.createElement('option');
                option.value = cat.id;
                option.textContent = cat.name;

                // Pilih default jika sesuai dengan transaksi yang sedang diedit
                if (cat.id === {{ $transaction->category_id }}) {
                    option.selected = true;
                }
                categorySelect.appendChild(option);
            });
        }

        // Ganti kategori saat type berubah
        typeSelect.addEventListener('change', function() {
            updateCategories(this.value);
        });

        // Set awal sesuai tipe transaksi
        updateCategories(typeSelect.value);
    });
</script>
@endsection
