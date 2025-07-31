@extends('layout.template')
@section('title', 'New Goal')

@section('content')
<div class="container-fluid px-5 py-5">
    {{-- HEADER PAGE --}}
    <div class="new-goal-header">
        <a href="{{ route('goalslist') }}">
            <img src="{{ asset('assets/images/leftarrow.png') }}" alt="Back" class="back-arrow-img">
        </a>
        <a class="page-title" href="{{ route('goalslist') }}">New Goal</a>
    </div>

    {{-- FORM --}}
    <form action="{{ route('storeGoal') }}" method="POST" id="goalForm">
        @csrf

        {{-- GOAL NAME --}}
        <div class="mb-5">
            <label for="goalName" class="input-title form-label">Goal Name</label>
            <input type="text" class="input-box form-control w-50" id="goalName" name="goalName"
                   placeholder="Enter your goal name" required>
        </div>

        {{-- TARGET DATE --}}
        <div class="mb-5">
            <label for="targetDate" class="input-title form-label">Target Date</label>
            <input type="date" class="input-box form-control w-50" id="targetDate" name="targetDate"
                   min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
        </div>

        {{-- GOAL AMOUNT --}}
        <div class="mb-5">
            <label for="goalAmount" class="input-title form-label">Goal Amount</label>
            <div class="d-flex align-items-center">
                <span class="input-title mb-0">IDR</span>
                <input type="number" class="input-box form-control ms-2 w-50" id="goalAmount"
                       name="goalAmount" placeholder="e.g. 1000000" required min="1">
            </div>
        </div>

        {{-- CHOOSE ICON --}}
        <div class="mb-5">
            <h2 class="input-title">Icons</h2>
            <div class="chooser-container">
                @php
                    $icons = [
                        'foodbw' => 'foodbw.png',
                        'presentbw' => 'presentbw.png',
                        'healthbw' => 'healthbw.png',
                        'paycheckbw' => 'paycheckbw.png',
                        'edubw' => 'edubw.png',
                        'groceriesbw' => 'groceriesbw.png',
                        'intbw' => 'intbw.png',
                    ];
                @endphp
                @foreach($icons as $key => $file)
                    <div class="icon-box {{ $loop->first ? 'active' : '' }}" data-icon-key="{{ $key }}">
                        <img src="{{ asset('assets/images/' . $file) }}" alt="{{ $key }} Icon">
                    </div>
                @endforeach
            </div>
            <input type="hidden" name="icon" id="iconInput" value="food.png">
        </div>

        {{-- CHOOSE COLOR --}}
        <div class="mb-5">
            <h2 class="input-title">Color</h2>
            <div class="d-flex justify-content-between align-items-center">
                <div class="chooser-container">
                    @php
                        $colors = ['#B9A400', '#6C00AA', '#3B9201', '#AA0000', '#AA007D'];
                    @endphp
                    @foreach($colors as $color)
                        <div class="color-swatch {{ $loop->iteration == 4 ? 'active' : '' }}"
                            data-color="{{ $color }}" style="background-color: {{ $color }}">
                            <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="color" id="colorInput" value="#AA0000">
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary btn-add-goal text-white">Add New Goal</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const iconBoxes = document.querySelectorAll('.icon-box');
        const colorSwatches = document.querySelectorAll('.color-swatch');
        const iconInput = document.getElementById('iconInput');
        const colorInput = document.getElementById('colorInput');

        const iconColorMap = {
            'foodbw': {
                '#B9A400': 'food.png',
                '#6C00AA': 'foodpurple.png',
                '#3B9201': 'foodgreen.png',
                '#AA0000': 'foodred.png',
                '#AA007D': 'foodpink.png'
            },
            'presentbw': {
                '#AA0000': 'present.png',
                '#B9A400': 'presentyellow.png',
                '#3B9201': 'presentgreen.png',
                '#AA007D': 'presentpink.png',
                '#6C00AA': 'presentpurple.png'
            },
            'healthbw': {
                '#3B9201': 'health.png',
                '#B9A400': 'healthyellow.png',
                '#AA007D': 'healthpink.png',
                '#6C00AA': 'healthpurple.png',
                '#AA0000': 'healthred.png'
            },
            'paycheckbw': {
                '#3B9201': 'paycheck.png',
                '#B9A400': 'paycheckyellow.png',
                '#AA007D': 'paycheckpink.png',
                '#6C00AA': 'paycheckpurple.png',
                '#AA0000': 'paycheckred.png'
            },
            'edubw': {
                '#6C00AA': 'edu.png',
                '#AA007D': 'edupink.png',
                '#3B9201': 'edugreen.png',
                '#AA0000': 'edured.png',
                '#B9A400': 'eduyellow.png'
            },
            'groceriesbw': {
                '#AA007D': 'groceries.png',
                '#B9A400': 'groceriesyellow.png',
                '#3B9201': 'groceriesgreen.png',
                '#6C00AA': 'groceriespurple.png',
                '#AA0000': 'groceriesred.png'
            },
            'intbw': {
                '#B9A400': 'int.png',
                '#AA0000': 'intred.png',
                '#3B9201': 'intgreen.png',
                '#AA007D': 'intpink.png',
                '#6C00AA': 'intpurple.png'
            }
        };

        let selectedIconKey = document.querySelector('.icon-box.active').dataset.iconKey;
        let selectedColor = document.querySelector('.color-swatch.active').dataset.color;
        iconInput.value = iconColorMap[selectedIconKey][selectedColor];
        colorInput.value = selectedColor;

        iconBoxes.forEach(box => {
            box.addEventListener('click', function () {
                iconBoxes.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                selectedIconKey = this.dataset.iconKey;
                updateIcon();
            });
        });

        colorSwatches.forEach(swatch => {
            swatch.addEventListener('click', function () {
                colorSwatches.forEach(s => s.classList.remove('active'));
                this.classList.add('active');
                selectedColor = this.dataset.color;
                colorInput.value = selectedColor;
                updateIcon();
            });
        });

        function updateIcon() {
            const newIcon = iconColorMap[selectedIconKey][selectedColor];
            iconInput.value = newIcon;
        }
    });
</script>
@endsection
