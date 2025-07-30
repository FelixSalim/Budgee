@extends('layout.template')
@section('title', 'Goals List')
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
            {{-- NAME --}}
            <div class="mb-5">
                <label for="goalName" class="input-title form-label">Goal Name</label>
                <input type="text" class="input-box form-control w-50" id="goalName" name="goalName"
                    placeholder="Enter your goal name">
            </div>

            {{-- DATE --}}
            <div class="mb-5">
                <label for="targetDate" class="input-title form-label">Target Date</label>
                <input type="date" class="input-box form-control w-50" id="targetDate" name="targetDate">
            </div>

            {{-- TARGET SAVING --}}
            <div class="mb-5">
                <label for="goalAmount" class="input-title form-label">Goal Amount</label>
                <div class="d-flex align-items-center">
                    <span class="input-title mb-0">IDR</span>
                    <input type="number" class="input-box form-control ms-2 w-50" id="goalAmount" name="goalAmount">
                </div>
            </div>

            {{-- CHOOSE ICON --}}
            <div class="mb-5">
                <h2 class="input-title">Icons</h2>
                <div class="chooser-container">
                    @php
                        $icons = [
                            'food' => 'foodbw.png',
                            'present' => 'presentbw.png',
                            'health' => 'healthbw.png',
                            'paycheck' => 'paycheckbw.png',
                            'education' => 'edubw.png',
                            'groceries' => 'groceriesbw.png',
                            'interest' => 'intbw.png',
                        ];
                    @endphp
                    @foreach($icons as $key => $file)
                        <div class="icon-box {{ $loop->first ? 'active' : '' }}" data-icon="{{ $file }}">
                            <img src="{{ asset('assets/images/' . $file) }}" alt="{{ $key }} Icon">
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="icon" id="iconInput" value="presentbw.png">
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
                            <div class="color-swatch {{ $loop->iteration == 4 ? 'active' : '' }}" data-color="{{ $color }}"
                                style="background-color: {{ $color }}">
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

            iconBoxes.forEach(box => {
                box.addEventListener('click', function () {
                    iconBoxes.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    iconInput.value = this.getAttribute('data-icon');
                });
            });

            colorSwatches.forEach(swatch => {
                swatch.addEventListener('click', function () {
                    colorSwatches.forEach(s => s.classList.remove('active'));
                    this.classList.add('active');
                    colorInput.value = this.getAttribute('data-color');
                });
            });
        });
    </script>
@endsection