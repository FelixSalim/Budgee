@extends('layout.template')
@section('title', 'Regular Payment')
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-end mb-4">
        <a href="/newregularpayment">
            <button class="btn btn-primary rounded-pill px-4">
            + New Regular Payment
        </button>
        </a>
    </div>

    <div class="card shadow-sm" style="border-radius: 1rem; width: 90%;">
        <div class="card-body">
            <h4 class="card-title mb-4">Regular Payment</h4>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
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
                        <!-- Example Row -->
                        <tr>
                            <td>
                                <img src="{{ asset('assets/icons/music-note-beamed.svg') }}" class="me-2" alt="Icon">
                                <span>Spotify</span>
                            </td>
                            <td>
                                <select class="form-select form-select-sm w-auto" disabled>
                                    <option value="paid">PAID</option>
                                    <option value="unpaid">UNPAID</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" value="IDR 13,000" disabled>
                            </td>
                            <td>
                                <select class="form-select form-select-sm w-auto" disabled>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ $i == 16 ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>02 day(s) 14 hour(s)</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-danger me-1 text-danger">
                                    <img src="{{ asset('assets/icons/trash.svg') }}" alt="Icon">
                                </button>
                                <button class="btn btn-sm btn-outline-secondary me-1 edit-btn">
                                    <img src="{{ asset('assets/icons/pencil.svg') }}" alt="Icon">
                                </button>
                                <button class="btn btn-sm btn-outline-success d-none save-btn">
                                    <img src="{{ asset('assets/icons/check.svg') }}" alt="Icon">
                                </button>
                            </td>
                        </tr>
                        <!-- Repeat for other rows -->
                        <tr>
                            <td>
                                <img src="{{ asset('assets/icons/music-note-beamed.svg') }}" class="me-2" alt="Icon">
                                <span>Spotify</span>
                            </td>
                            <td>
                                <select class="form-select form-select-sm w-auto" disabled>
                                    <option value="paid">PAID</option>
                                    <option value="unpaid">UNPAID</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" value="IDR 13,000" disabled>
                            </td>
                            <td>
                                <select class="form-select form-select-sm w-auto" disabled>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ $i == 16 ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>02 day(s) 14 hour(s)</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-danger me-1 text-danger">
                                    <img src="{{ asset('assets/icons/trash.svg') }}" alt="Icon">
                                </button>
                                <button class="btn btn-sm btn-outline-secondary me-1 edit-btn">
                                    <img src="{{ asset('assets/icons/pencil.svg') }}" alt="Icon">
                                </button>
                                <button class="btn btn-sm btn-outline-success d-none save-btn">
                                    <img src="{{ asset('assets/icons/check.svg') }}" alt="Icon">
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
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
                row.querySelectorAll('select, input').forEach(el => el.disabled = true);
                saveBtn.classList.add('d-none');
                editBtn.classList.remove('d-none');
                // Optionally, submit data via AJAX here
            });
        }
    });
});
</script>
@endsection
