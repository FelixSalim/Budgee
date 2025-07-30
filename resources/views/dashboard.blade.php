@extends('layout.template')
@section('title', 'Dashboard')
@section('extra-css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endsection
@section('content')
    <div class="row p-3 m-3 title-section">
        <div class="col p-0">
            <h1 class="h1 p-0 m-0 dashboard-title">Dashboard</h1>
            <p class="p-0 m-0 dashboard-subtitle">Track and Analyze Your Financial Performance</p>
        </div>
        <div class="col p-0 justify-content-end d-flex align-items-center">
            <div class="notification-icon-container mx-4">
                <a href="#" class="text-decoration-none text-dark">
                    <img src="{{ asset('assets/icons/iconoir_bell-notification.png') }}" class="bell-icon" alt="Notification Icon">
                </a>
            </div>
            <div class="profile-icon-container ms-1">
                <a href="#" class="text-decoration-none text-dark">
                    
                </a>
            </div>
        </div>
    </div>
    <div class="row d-flex flex-row mx-3">
        <div class="col-7">
            <div class="row mb-4 mt-0 mx-0 px-4 py-3 balance-container">
                <h1 class="balance-title my-2 mx-0 p-0">
                    Current Balance
                </h1>
                <div class="row my-1 mx-0 p-0 d-flex flex-row align-items-center justify-content-between">
                    {{-- Database --}}
                    <div class="m-0 p-0" style="width: auto;">
                        <h1 class="balance m-0 p-0">
                            {{ Auth::user()->currency }} {{ number_format($balance, 2) }}
                        </h1>
                    </div>
                    <div class="m-0 p-0 d-flex flex-row" style="width: auto;">
                        <div class="me-3 ms-0 my-0 p-0">
                            <a href="{{ route('newtransaction') }}">
                                <button class="btn add-button">
                                    + Add
                                </button>
                            </a>
                        </div>
                        <div class="ms-2 me-0 my-0 p-0">
                           <form action="{{ route('home') }}" method="GET">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle month-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $months[$selectedMonthYear] ?? 'Month' }}
                                    </button>
                                    <ul class="dropdown-menu">
                                        @foreach($months as $num => $name)
                                            <li>
                                                <a class="dropdown-item" href="{{ route('home', ['month' => $num]) }}">
                                                    {{ $name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row mx-0 mt-4 mb-1 pt-3 pb-0 px-0">
                    <div class="col m-0 p-0">
                        <div class="d-flex income-container align-items-center m-0">
                            <img src="{{ asset('assets/icons/incomes-icon.png') }}" alt="" width="35" height="35">
                            <div class="income-details mx-3">
                                <p class="income-title mx-0 my-1 p-0">Incomes</p>
                                <p class="income mx-0 my-1 p-0">{{ Auth::user()->currency }} {{ number_format($totalIncome, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col ms-4 me-0 my-0 p-0">
                        <div class="d-flex expense-container align-items-center m-0">
                            <img src="{{ asset('assets/icons/expenses-icon.png') }}" alt="" width="35" height="35">
                            <div class="expense-details mx-3">
                                <p class="expense-title mx-0 my-1 p-0">Expenses</p>
                                <p class="expense mx-0 my-1 p-0">{{ Auth::user()->currency }} {{ number_format($totalExpense, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 mx-0 mb-0 p-4 transaction-history-container">
                <div class="d-flex justify-content-between align-items-center mb-3 ms-0 me-0 mt-0 p-0">
                    <h1 class="transaction-history-title h1 my-2 mx-0 p-0">Recent Cash Flow - {{ $months[$selectedMonthYear] ?? 'All Months' }}</h1>
                    <div class="m-0 p-0">
                        <a href="{{ route('transactions') }}">
                            <button class="btn see-more-button">
                                See More
                            </button>
                        </a>
                    </div>
                </div>
                <table class="table table-hover mt-3">
                    <thead class="table-head">
                        <tr>
                            <th scope="col">Categories</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Date</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions as $transaction)
                            <tr>
                                <td class="py-3">
                                    <div class="row d-flex align-items-center m-0 p-0">
                                        <div class="col-3 d-flex justify-content-center align-items-center me-2 ms-0 my-0 icon-container"
                                            style="background-color: {{ $transaction->category->icon_color }}">
                                            @if($transaction->category && $transaction->category->icon)
                                                @php
                                                    $iconBase = pathinfo($transaction->category->icon, PATHINFO_FILENAME); // remove extension
                                                    $iconFile = $iconBase . 'bw.png'; // add bw.png
                                                @endphp
                                                <img
                                                    width="22.5" height="22.5"
                                                    src="{{ asset('assets/images/' . $iconFile) }}"
                                                    alt="{{ $transaction->category->name }} Icon"
                                                    class="m-0 p-0 white-icon">
                                            @endif
                                        </div>
                                        <div class="col m-0 p-0">
                                            <p class="m-0 p-0">{{ $transaction->category->name ?? 'Uncategorized' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $transaction->description ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-y') }}</td>
                                <td class="{{ $transaction->type === 'income' ? 'amount-increase' : 'amount-decrease' }}">
                                    {{ $transaction->type === 'income' ? '+' : '-' }}
                                    {{ Auth::user()->currency }} {{ number_format($transaction->amount, 0) }}
                                </td>
                                <td>
                                    <a href="{{ route('transaction.show', $transaction->id) }}" class="btn detail-btn">
                                        Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">No transactions found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-5">
            <div class="d-flex flex-column m-0 p-0 category-container">
                <div class="row m-0 d-flex flex-row align-items-center justify-content-between category-title-container">
                    <div class="m-0 py-2 px-2" style="width: auto;">
                        <h1 class="category-title m-0 py-1 px-0">
                            Categories - {{ $months[$selectedMonthYear] ?? 'All Months' }}
                        </h1>
                    </div>
                    <div class="m-0 py-2 px-2" style="width: auto;">
                        <form action="{{ route('home') }}" method="GET">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle month-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $months[$selectedMonthYear] ?? 'Month' }}
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach($months as $num => $name)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('home', ['month' => $num]) }}">
                                                {{ $name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row income-expense-selector d-flex justify-content-evenly my-3 mx-0 p-0">
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <a href="#" class="active-selector">Expenses</a>
                    </div>
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <a href="#">Incomes</a>
                    </div>
                </div>  
                <div class="d-flex justify-content-center align-items-center">
                    <canvas id="chart" class="m-0 p-0" width="250" height="250"></canvas>
                    <div class="position-absolute">
                        <p class="total m-0 p-0">
                            {{ Auth::user()->currency }} {{ number_format($totalExpense, 0) }}
                        </p>
                        <p class="total-title m-0 p-0">
                            Total Expense
                        </p>
                    </div>
                </div>
                <div class="legends my-3 mx-0 px-5 py-0 d-flex flex-column">
            
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-script')
    <script>
        const expenseData = @json($expenseData);
        const incomeData = @json($incomeData);

        var Options = {
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: true,
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': {{ Auth::user()->currency }}' + tooltipItem.raw.toLocaleString();
                        }
                    }
                }
            },
            cutout: '70%',
            responsive: true,
            maintainAspectRatio: false,
        }

        // Render legends dynamically
        function renderLegends(data) {
            let total = data.reduce((sum, cat) => sum + cat.total, 0);
            let legendHtml = '';

            data.forEach(cat => {
                let percentage = total ? ((cat.total / total) * 100).toFixed(0) : 0;
                let overBudget = cat.planned_outlay > 0 && cat.total > cat.planned_outlay;

                legendHtml += `
                    <div class="d-flex flex-row align-items-center justify-content-between mx-0 my-1 p-0 legend-items">
                        <div class="m-0 p-0 icon-container" style="background-color:${cat.color}">
                            <img width="22.5" height="22.5" src="/assets/images/${cat.icon}" class="white-icon">
                        </div>
                        <p class="mx-2 my-0 p-0 w-25">${cat.name}</p>
                        <p class="mx-2 my-0 p-0">${percentage}%</p>
                        <p class="mx-2 my-0 p-0 ${overBudget ? 'text-danger' : ''}">
                            {{ Auth::user()->currency }} ${cat.total.toLocaleString()}
                            <span class="text-muted" style="font-size:0.85em">
                                of {{ Auth::user()->currency }} ${cat.planned_outlay.toLocaleString()}
                            </span>
                        </p>
                    </div>
                `;
            });

            document.querySelector('.legends').innerHTML = legendHtml;
        }

        function updateCenterText(amount, label) {
            const totalEl = document.querySelector('.total');
            const titleEl = document.querySelector('.total-title');

            const formatted = '{{ Auth::user()->currency }} ' + amount.toLocaleString();

            totalEl.textContent = formatted;
            titleEl.textContent = label;

            // Scale font based on length
            if (formatted.length > 15) {
                totalEl.style.fontSize = '1.2rem';
            } else if (formatted.length > 10) {
                totalEl.style.fontSize = '1.5rem';
            } else {
                totalEl.style.fontSize = '2rem';
            }
        }

        // Convert Laravel data to Chart.js dataset format
        function toChartData(data) {
            return {
                labels: data.map(cat => cat.name),
                datasets: [{
                    data: data.map(cat => cat.total),
                    backgroundColor: data.map(cat => cat.color),
                }]
            };
        }
        // Initialize Chart.js
        const expenseChartData = toChartData(expenseData);
        const incomeChartData = toChartData(incomeData);

        // Initial render
        renderLegends(expenseData);
        updateCenterText(expenseData.reduce((a, b) => a + b.total, 0), 'Total Expense');
    </script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection