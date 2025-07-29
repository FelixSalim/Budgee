@extends('layout.template')
@section('title', 'Regular Payment')
@section('content')
<div class="container mt-5">
    <div class="d-flex mb-4 ms-5 me-5" style="justify-content: space-between; align-items: center; color: rgb(0, 92, 171);">
        <div class="d-flex justify-content-start align-items-center">
            <h2 class="card-title">Regular Payment</h2>
        </div>
        <div class="d-flex justify-content-end">
            <a href="/newregularpayment">
                <button class="btn btn-primary rounded-pill px-4" style="background-color: rgb(0, 92, 171)">
                + New Regular Payment
            </button>
            </a>
        </div>
    </div>

    <div class="card shadow-sm ms-5" style="border-radius: 1rem; width: 90%;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Transaction</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Due Date</th>
                            <th>Time Left to Pay</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($regularPayments as $payment)
                        <tr data-id="{{ $payment->id }}">
                            <td>
                                <img src="{{ asset('assets/icons/' . $payment->icon) }}" class="me-2" alt="Icon">
                                <span>{{ $payment->name }}</span>
                            </td>
                            <td>
                                <select class="form-select form-select-sm w-auto status-select rounded-4" disabled>
                                    <option value="paid" {{ $payment->status === 'paid' ? 'selected' : '' }}>PAID</option>
                                    <option value="unpaid" {{ $payment->status === 'unpaid' ? 'selected' : '' }}>UNPAID</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" value="IDR {{ number_format($payment->amount, 0, ',', '.') }}" disabled>
                            </td>
                            <td>
                                <select class="form-select form-select-sm w-auto" disabled>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ $payment->due_date == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                @php
                                    $now = \Carbon\Carbon::now();
                                    $dueDay = $payment->due_date;
                                    $nextDueDate = \Carbon\Carbon::createFromDate($now->year, $now->month, $dueDay);

                                    if ($nextDueDate->lessThan($now)) {
                                        $nextDueDate->addMonth();
                                    }

                                    $diff = $now->diff($nextDueDate);
                                @endphp
                                {{ $diff->d }} day(s) {{ $diff->h }} hour(s)

                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-danger me-1 text-danger">
                                    <img src="{{ asset('assets/icons/trash.svg') }}" alt="Delete">
                                </button>
                                <button class="btn btn-sm btn-outline-secondary me-1 edit-btn">
                                    <img src="{{ asset('assets/icons/pencil.svg') }}" alt="Edit">
                                </button>
                                <button class="btn btn-sm btn-outline-success d-none save-btn">
                                    <img src="{{ asset('assets/icons/check.svg') }}" alt="Save">
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No regular payments found.</td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to set background color based on value
    function updateStatusSelectBg(select) {
        if (select.value === 'paid') {
            select.style.backgroundColor = 'rgb(11, 136, 0)';
            select.style.color = 'white';
        } else if (select.value === 'unpaid') {
            select.style.backgroundColor = 'rgb(213, 0, 0)';
            select.style.color = 'white';
        }
    }

    // Initialize all status-select backgrounds
    document.querySelectorAll('.status-select').forEach(function(select) {
        updateStatusSelectBg(select);
        select.addEventListener('change', function() {
            updateStatusSelectBg(this);
        });
    });

    // Edit/Save logic with proper AJAX handling
    document.querySelectorAll('tr').forEach(function(row) {
        const editBtn = row.querySelector('.edit-btn');
        const saveBtn = row.querySelector('.save-btn');
        
        if (editBtn && saveBtn) {
            editBtn.addEventListener('click', function() {
                row.querySelectorAll('select, input').forEach(el => el.disabled = false);
                editBtn.classList.add('d-none');
                saveBtn.classList.remove('d-none');
            });
            
            saveBtn.addEventListener('click', function() {
                const paymentId = row.dataset.id;
                const status = row.querySelector('.status-select').value;
                const amountInput = row.querySelector('input[type="text"]');
                // Extract only numbers from the amount (remove "IDR" and formatting)
                const amount = amountInput.value.replace(/[^0-9]/g, '');
                const dueDate = row.querySelectorAll('select')[1].value;
                
                // Create form data for POST request
                const formData = new FormData();
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
                formData.append('_method', 'PUT'); // Laravel's way to handle PUT requests via POST
                formData.append('status', status);
                formData.append('amount', amount);
                formData.append('due_date', dueDate);
                
                // Show loading state
                saveBtn.disabled = true;
                saveBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';
                
                fetch(`/regularpayment/update/${paymentId}`, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Re-enable fields and show edit button
                    row.querySelectorAll('select, input').forEach(el => el.disabled = true);
                    saveBtn.classList.add('d-none');
                    editBtn.classList.remove('d-none');
                    
                    // Reset save button
                    saveBtn.disabled = false;
                    saveBtn.innerHTML = '<img src="{{ asset('assets/icons/check.svg') }}" alt="Save">';
                    
                    // Update the amount display with formatted value
                    amountInput.value = 'IDR ' + parseInt(amount).toLocaleString('id-ID');
                    
                    // Show success message
                    alert('Payment updated successfully!');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error updating payment. Please try again.');
                    
                    // Reset save button
                    saveBtn.disabled = false;
                    saveBtn.innerHTML = '<img src="{{ asset('assets/icons/check.svg') }}" alt="Save">';
                });
            });
        }
    });
});
</script>
@endsection
