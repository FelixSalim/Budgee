@extends('layout.template')

@section('title', 'New Regular Payment')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('assets/css/newcategory.css') }}">
@endsection

@section('content')
<div class="container mt-5 ms-5" style="max-width: 700px;">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('regularpayment') }}">
            <img src="{{ asset('assets/images/leftarrow.png') }}" alt="Back" class="back-arrow-img me-4" style="width: 0.6rem; height: 1rem;">
        </a>
        <h4 class="m-0" style="color: rgb(0, 92, 171)">New Regular Payment</h4>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <form action="{{ route('regularpayment.store') }}" method="POST">
            @csrf

            <div class="row align-items-center mb-4">
                <div class="col-md-4 d-flex justify-content-center mb-4 mb-md-0">
                    <div class="preview-card" id="previewCard">
                        <img src="{{ asset('assets/images/present.png') }}" alt="Present Icon" id="previewIcon">
                        <span class="category-name-preview" id="previewName" style="color: #AA0000;">Payment</span>
                    </div>
                </div>
                <div class="col-md-8">
                    <input type="text" name="transaction" id="transactionInput" class="form-control border-0 border-bottom border-primary rounded-0 shadow-none mb-3" placeholder="Regular Payment Name" required>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col">
                    <label class="form-label text-muted">Amount</label>
                    <div class="input-group border-bottom border-primary">
                        <span class="input-group-text bg-white border-0 shadow-none text-muted">{{ Auth::user()->currency }}</span>
                        <input type="number" name="amount" class="form-control border-0 shadow-none" placeholder="100,000">
                    </div>
                </div>
                <div class="col">
                    <label class="form-label text-muted">Due Date</label>
                    <select name="due_date" class="form-select border-0 border-bottom border-primary rounded-0 shadow-none">
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}" {{ $i == 1 ? 'selected' : '' }}>Every {{ $i }}th</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <h6 class="text-muted">Choose Icon</h6>
                <div class="chooser-container">
                    @php
                        $icons = ['foodbw', 'presentbw', 'healthbw', 'paycheckbw', 'edubw', 'groceriesbw', 'intbw'];
                    @endphp
                    @foreach ($icons as $icon)
                        <div class="icon-box {{ $icon == 'presentbw' ? 'active' : '' }}" data-icon-src="{{ $icon }}.png" data-full-icon-path="{{ asset('assets/images/'.$icon.'.png') }}">
                            <img src="{{ asset('assets/images/'.$icon.'.png') }}" alt="Icon">
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="icon" id="selectedIcon" value="present.png">
                <input type="hidden" name="icon_src_bw" id="selectedIconBw" value="presentbw.png">
            </div>

            <div class="mb-4">
                <h6 class="text-muted">Choose Color</h6>
                <div class="chooser-container">
                    @php
                        $colors = ['#B9A400', '#6C00AA', '#3B9201', '#AA0000', '#AA007D'];
                    @endphp
                    @foreach ($colors as $color)
                        <div class="color-swatch {{ $color == '#AA0000' ? 'active' : '' }}" data-color="{{ $color }}" style="background-color: {{ $color }}">
                            <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                        </div>
                    @endforeach
                </div>
                <input type="hidden" name="icon_color" id="selectedColor" value="#AA0000">
            </div>

            <div class="mt-4 text-end">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill" style="background-color: rgb(0, 92, 171)">
                    Add Regular Payment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('extra-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const iconBoxes = document.querySelectorAll('.icon-box');
    const colorSwatches = document.querySelectorAll('.color-swatch');
    const selectedIconInput = document.getElementById('selectedIcon');
    const selectedColorInput = document.getElementById('selectedColor');
    const selectedIconBwInput = document.getElementById('selectedIconBw');
    const previewIcon = document.getElementById('previewIcon');
    const previewNameSpan = document.getElementById('previewName');
    const transactionInput = document.getElementById('transactionInput');

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

    function updatePreview() {
        const activeIconBox = document.querySelector('.icon-box.active');
        const activeColorSwatch = document.querySelector('.color-swatch.active');

        if (!activeIconBox || !activeColorSwatch) return;

        const iconKey = activeIconBox.dataset.iconSrc.replace('.png', '');
        const colorKey = activeColorSwatch.dataset.color;

        previewNameSpan.style.color = colorKey;
        selectedColorInput.value = colorKey;
        selectedIconBwInput.value = activeIconBox.dataset.iconSrc;

        const pathParts = activeIconBox.dataset.fullIconPath.split('/');
        pathParts.pop();
        const imageBasePath = pathParts.join('/');

        const newIconFilename = iconColorMap[iconKey]?.[colorKey];
        previewIcon.src = newIconFilename ? `${imageBasePath}/${newIconFilename}` : activeIconBox.dataset.fullIconPath;
        selectedIconInput.value = newIconFilename ?? activeIconBox.dataset.iconSrc;
    }

    iconBoxes.forEach(box => {
        box.addEventListener('click', function () {
            iconBoxes.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            updatePreview();
        });
    });

    colorSwatches.forEach(swatch => {
        swatch.addEventListener('click', function () {
            colorSwatches.forEach(s => s.classList.remove('active'));
            this.classList.add('active');
            updatePreview();
        });
    });

    transactionInput.addEventListener('input', () => {
        previewNameSpan.textContent = transactionInput.value || 'Payment';
    });

    updatePreview();
});
</script>
@endsection
