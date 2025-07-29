@extends('layout.template')

@section('title', 'New Category')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('assets/css/newcategory.css') }}">
@endsection

@section('content')

<div class="container-fluid px-5 py-5">
    <div class="new-category-header">
        <a href="{{ url()->previous() }}" class="back-arrow-link">
            <img src="{{ asset('assets/images/leftarrow.png') }}" alt="Back" class="back-arrow-img">
        </a>
        <a class="page-title" href="{{route('categories')}}">New Category</a>
    </div>

    <div class="row">
        <div class="col-lg-9 col-xl-8">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="row align-items-center mb-5">
                    <div class="col-md-4 d-flex justify-content-center mb-4 mb-md-0">
                        <div class="preview-card" id="previewCard">
                            {{-- Initial image from the active icon-box --}}
                            <img src="{{ asset('assets/images/present.png') }}" alt="Present Icon" id="previewIcon">
                            <span class="category-name-preview" id="previewName" style="color: #AA0000;">Present</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-4">
                            <input type="text" class="form-control form-control-underline @error('name') is-invalid @enderror" id="categoryName" name="name" placeholder="Category Name" value="{{ old('name', 'Present') }}">
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex gap-4">
                            <div class="form-check form-check-custom">
                                <input class="form-check-input" type="radio" name="type" id="expensesRadio" value="expense" {{ old('type', 'expense') == 'expense' ? 'checked' : '' }}>
                                <label class="form-check-label" for="expensesRadio">Expenses</label>
                            </div>
                            <div class="form-check form-check-custom">
                                <input class="form-check-input" type="radio" name="type" id="incomeRadio" value="income" {{ old('type') == 'income' ? 'checked' : '' }}>
                                <label class="form-check-label" for="incomeRadio">Income</label>
                            </div>
                            @error('type')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h2 class="section-heading">Planned Outlay</h2>
                    <div class="d-flex align-items-end gap-3">
                        <div class="col-6 col-md-5 col-lg-4">
                            <input type="text" class="form-control form-control-underline @error('planned_outlay') is-invalid @enderror" id="plannedOutlay" name="planned_outlay" placeholder="Not set" value="{{ old('planned_outlay') }}">
                            @error('planned_outlay')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <span class="info-text">{{ Auth::user()->currency ?? 'IDR' }} per month</span>
                    </div>
                </div>

                <div class="mb-5">
                    <h2 class="section-heading">Icons</h2>
                    <div class="chooser-container">
                        <div class="icon-box {{ old('icon_src_bw', 'presentbw.png') == 'foodbw.png' ? 'active' : '' }}" data-icon-src="foodbw.png" data-full-icon-path="{{ asset('assets/images/foodbw.png') }}">
                            <img src="{{ asset('assets/images/foodbw.png') }}" alt="Food Icon">
                        </div>
                        <div class="icon-box {{ old('icon_src_bw', 'presentbw.png') == 'presentbw.png' ? 'active' : '' }}" data-icon-src="presentbw.png" data-full-icon-path="{{ asset('assets/images/presentbw.png') }}">
                            <img src="{{ asset('assets/images/presentbw.png') }}" alt="Present Icon">
                        </div>
                        <div class="icon-box {{ old('icon_src_bw') == 'healthbw.png' ? 'active' : '' }}" data-icon-src="healthbw.png" data-full-icon-path="{{ asset('assets/images/healthbw.png') }}">
                            <img src="{{ asset('assets/images/healthbw.png') }}" alt="Health Icon">
                        </div>
                        <div class="icon-box {{ old('icon_src_bw') == 'paycheckbw.png' ? 'active' : '' }}" data-icon-src="paycheckbw.png" data-full-icon-path="{{ asset('assets/images/paycheckbw.png') }}">
                            <img src="{{ asset('assets/images/paycheckbw.png') }}" alt="Paycheck Icon">
                        </div>
                        <div class="icon-box {{ old('icon_src_bw') == 'edubw.png' ? 'active' : '' }}" data-icon-src="edubw.png" data-full-icon-path="{{ asset('assets/images/edubw.png') }}">
                            <img src="{{ asset('assets/images/edubw.png') }}" alt="Education Icon">
                        </div>
                        <div class="icon-box {{ old('icon_src_bw') == 'groceriesbw.png' ? 'active' : '' }}" data-icon-src="groceriesbw.png" data-full-icon-path="{{ asset('assets/images/groceriesbw.png') }}">
                            <img src="{{ asset('assets/images/groceriesbw.png') }}" alt="Groceries Icon">
                        </div>
                        <div class="icon-box {{ old('icon_src_bw') == 'intbw.png' ? 'active' : '' }}" data-icon-src="intbw.png" data-full-icon-path="{{ asset('assets/images/intbw.png') }}">
                            <img src="{{ asset('assets/images/intbw.png') }}" alt="Interest Icon">
                        </div>
                    </div>
                    {{-- Hidden input to store the selected icon filename --}}
                    <input type="hidden" name="icon" id="selectedIcon" value="{{ old('icon', 'present.png') }}">
                    <input type="hidden" name="icon_src_bw" id="selectedIconBw" value="{{ old('icon_src_bw', 'presentbw.png') }}">
                    @error('icon')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <h2 class="section-heading">Color</h2>
                    <div class="chooser-container">
                        <div class="color-swatch {{ old('icon_color') == '#B9A400' ? 'active' : '' }}" data-color="#B9A400" style="background-color: #B9A400;">
                            <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                        </div>
                        <div class="color-swatch {{ old('icon_color') == '#6C00AA' ? 'active' : '' }}" data-color="#6C00AA" style="background-color: #6C00AA;">
                            <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                        </div>
                        <div class="color-swatch {{ old('icon_color') == '#3B9201' ? 'active' : '' }}" data-color="#3B9201" style="background-color: #3B9201;">
                            <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                        </div>
                        <div class="color-swatch {{ old('icon_color', '#AA0000') == '#AA0000' ? 'active' : '' }}" data-color="#AA0000" style="background-color: #AA0000;">
                            <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                        </div>
                        <div class="color-swatch {{ old('icon_color') == '#AA007D' ? 'active' : '' }}" data-color="#AA007D" style="background-color: #AA007D;">
                            <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                        </div>
                    </div>
                    {{-- Hidden input to store the selected color hex code --}}
                    <input type="hidden" name="icon_color" id="selectedColor" value="{{ old('icon_color', '#AA0000') }}">
                    @error('icon_color')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary btn-add-category text-white">Add New Category</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@section('extra-script')
    <script>
    document.addEventListener('DOMContentLoaded', function() {

    // --- Elemen DOM ---
    const categoryNameInput = document.getElementById('categoryName');
    const previewNameSpan = document.getElementById('previewName');
    const previewIcon = document.getElementById('previewIcon');
    const iconBoxes = document.querySelectorAll('.icon-box');
    const colorSwatches = document.querySelectorAll('.color-swatch');
    const selectedIconInput = document.getElementById('selectedIcon'); // Hidden input for icon
    const selectedColorInput = document.getElementById('selectedColor'); // Hidden input for color
    const selectedIconBwInput = document.getElementById('selectedIconBw'); // Hidden input for bw icon source


    // --- Mapping icon colors ---
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

// --- UPDATE PREVIEW ALL OVER ---
    function updatePreview() {
        const activeIconBox = document.querySelector('.icon-box.active');
        const activeColorSwatch = document.querySelector('.color-swatch.active');

        if (!activeIconBox || !activeColorSwatch) {
            // Set default values if no active icon/color is found (e.g., on first load)
            selectedIconInput.value = 'present.png'; // Default active icon filename
            selectedColorInput.value = '#AA0000'; // Default active color
            selectedIconBwInput.value = 'presentbw.png'; // Default active bw icon filename

            // Set default preview image and color if not already set
            previewIcon.src = `{{ asset('assets/images/present.png') }}`;
            previewNameSpan.style.color = '#AA0000';
            return;
        }

        const baseIconSrc = activeIconBox.dataset.fullIconPath;
        const pathParts = baseIconSrc.split('/');
        pathParts.pop();
        const imageBasePath = pathParts.join('/');

        const iconKey = activeIconBox.dataset.iconSrc.replace('.png', '');
        const colorKey = activeColorSwatch.dataset.color;

        // Update preview name color and hidden input
        previewNameSpan.style.color = colorKey;
        selectedColorInput.value = colorKey;

        // Update hidden input for the black & white icon source
        selectedIconBwInput.value = activeIconBox.dataset.iconSrc;

        const newIconFilename = iconColorMap[iconKey]?.[colorKey];

        if (newIconFilename) {
            previewIcon.src = `${imageBasePath}/${newIconFilename}`;
            selectedIconInput.value = newIconFilename; // Store the colored icon filename
        } else {
            // Fallback to the black and white icon if no colored version is mapped
            previewIcon.src = baseIconSrc;
            selectedIconInput.value = activeIconBox.dataset.iconSrc; // Store the bw icon filename
        }

        // Update preview name text
        const newName = categoryNameInput.value;
        previewNameSpan.textContent = newName ? newName : 'Category';
    }

// --- EVENT LISTENER FOR CATEGORY ---
    categoryNameInput.addEventListener('input', function() {
        const newName = categoryNameInput.value;
        previewNameSpan.textContent = newName ? newName : 'Category';
    });

    // --- EVENT LISTENER FOR ICON ---
    iconBoxes.forEach(box => {
        box.addEventListener('click', function() {
            iconBoxes.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            updatePreview();
        });
    });

    // --- EVENT LISTENER FOR ICON COLOR ---
    colorSwatches.forEach(swatch => {
        swatch.addEventListener('click', function() {
            colorSwatches.forEach(s => s.classList.remove('active'));
            this.classList.add('active');
            updatePreview();
        });
    });

    // Call updatePreview() on initial load to set correct preview and hidden input values
    updatePreview();

    // Re-select active items based on old input if validation failed
    const oldIconBw = '{{ old('icon_src_bw', 'presentbw.png') }}';
    const oldColor = '{{ old('icon_color', '#AA0000') }}';

    iconBoxes.forEach(box => {
        if (box.dataset.iconSrc === oldIconBw) {
            iconBoxes.forEach(b => b.classList.remove('active'));
            box.classList.add('active');
        }
    });

    colorSwatches.forEach(swatch => {
        if (swatch.dataset.color === oldColor) {
            colorSwatches.forEach(s => s.classList.remove('active'));
            swatch.classList.add('active');
        }
    });

    // Re-run updatePreview to ensure the preview and hidden fields reflect old input
    // after setting active classes.
    updatePreview();
});
</script>
@endsection

