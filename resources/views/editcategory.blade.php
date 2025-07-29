@extends('layout.template')

@section('title', 'Edit Category')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('assets/css/newcategory.css') }}">
@endsection

@section('content')

<div class="container-fluid px-5 py-5">
    <div class="new-category-header">
        <a href="{{ route('categories') }}">
            <img src="{{ asset('assets/images/leftarrow.png') }}" alt="Back" class="back-arrow-img">
        </a>
        <a class="page-title" href="{{route('categories')}}">Edit Category</a>
    </div>

    <div class="row">
        <div class="col-lg-9 col-xl-8">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row align-items-center mb-5">
                    <div class="col-md-4 d-flex justify-content-center mb-4 mb-md-0">
                        <div class="preview-card" id="previewCard">
                            <img src="{{ asset('assets/images/' . $category->icon) }}" alt="{{ $category->name }} Icon" id="previewIcon">
                            <span class="category-name-preview" id="previewName" style="color: {{ $category->icon_color }}">{{ old('name', $category->name) }}</span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-4">
                            <input type="text" class="form-control form-control-underline @error('name') is-invalid @enderror" id="categoryName" name="name" placeholder="Category Name" value="{{ old('name', $category->name) }}">
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex gap-4">
                            <div class="form-check form-check-custom">
                                <input class="form-check-input" type="radio" name="type" id="expensesRadio" value="expense" {{ old('type', $category->type) == 'expense' ? 'checked' : '' }}>
                                <label class="form-check-label" for="expensesRadio">Expenses</label>
                            </div>
                            <div class="form-check form-check-custom">
                                <input class="form-check-input" type="radio" name="type" id="incomeRadio" value="income" {{ old('type', $category->type) == 'income' ? 'checked' : '' }}>
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
                            <input type="text" class="form-control form-control-underline @error('planned_outlay') is-invalid @enderror" id="plannedOutlay" name="planned_outlay" placeholder="Not set" value="{{ old('planned_outlay', $category->planned_outlay) }}">
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
                        @php
                            $categoryIconBaseName = str_replace(['yellow', 'purple', 'green', 'red', 'pink'], '', pathinfo($category->icon, PATHINFO_FILENAME));
                            $categoryIconBaseName = $categoryIconBaseName . 'bw.png';
                        @endphp

                        <div class="icon-box {{ old('icon_src_bw', $categoryIconBaseName) == 'foodbw.png' ? 'active' : '' }}" data-icon-src="foodbw.png" data-full-icon-path="{{ asset('assets/images/foodbw.png') }}">
                            <img src="{{ asset('assets/images/foodbw.png') }}" alt="Food Icon">
                        </div>
                        <div class="icon-box {{ old('icon_src_bw', $categoryIconBaseName) == 'presentbw.png' ? 'active' : '' }}" data-icon-src="presentbw.png" data-full-icon-path="{{ asset('assets/images/presentbw.png') }}">
                            <img src="{{ asset('assets/images/presentbw.png') }}" alt="Present Icon">
                        </div>
                        <div class="icon-box {{ old('icon_src_bw', $categoryIconBaseName) == 'healthbw.png' ? 'active' : '' }}" data-icon-src="healthbw.png" data-full-icon-path="{{ asset('assets/images/healthbw.png') }}">
                            <img src="{{ asset('assets/images/healthbw.png') }}" alt="Health Icon">
                        </div>
                        <div class="icon-box {{ old('icon_src_bw', $categoryIconBaseName) == 'paycheckbw.png' ? 'active' : '' }}" data-icon-src="paycheckbw.png" data-full-icon-path="{{ asset('assets/images/paycheckbw.png') }}">
                            <img src="{{ asset('assets/images/paycheckbw.png') }}" alt="Paycheck Icon">
                        </div>
                        <div class="icon-box {{ old('icon_src_bw', $categoryIconBaseName) == 'edubw.png' ? 'active' : '' }}" data-icon-src="edubw.png" data-full-icon-path="{{ asset('assets/images/edubw.png') }}">
                            <img src="{{ asset('assets/images/edubw.png') }}" alt="Education Icon">
                        </div>
                        <div class="icon-box {{ old('icon_src_bw', $categoryIconBaseName) == 'groceriesbw.png' ? 'active' : '' }}" data-icon-src="groceriesbw.png" data-full-icon-path="{{ asset('assets/images/groceriesbw.png') }}">
                            <img src="{{ asset('assets/images/groceriesbw.png') }}" alt="Groceries Icon">
                        </div>
                        <div class="icon-box {{ old('icon_src_bw', $categoryIconBaseName) == 'intbw.png' ? 'active' : '' }}" data-icon-src="intbw.png" data-full-icon-path="{{ asset('assets/images/intbw.png') }}">
                            <img src="{{ asset('assets/images/intbw.png') }}" alt="Interest Icon">
                        </div>
                    </div>
                    {{-- Hidden input to store the selected icon filename --}}
                    <input type="hidden" name="icon" id="selectedIcon" value="{{ old('icon', $category->icon) }}">
                    <input type="hidden" name="icon_src_bw" id="selectedIconBw" value="{{ old('icon_src_bw', $categoryIconBaseName) }}">
                    @error('icon')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-5">
                    <h2 class="section-heading">Color</h2>
                    <div class="chooser-container">
                        <div class="color-swatch {{ old('icon_color', $category->icon_color) == '#B9A400' ? 'active' : '' }}" data-color="#B9A400" style="background-color: #B9A400;">
                            <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                        </div>
                        <div class="color-swatch {{ old('icon_color', $category->icon_color) == '#6C00AA' ? 'active' : '' }}" data-color="#6C00AA" style="background-color: #6C00AA;">
                            <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                        </div>
                        <div class="color-swatch {{ old('icon_color', $category->icon_color) == '#3B9201' ? 'active' : '' }}" data-color="#3B9201" style="background-color: #3B9201;">
                            <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                        </div>
                        <div class="color-swatch {{ old('icon_color', $category->icon_color) == '#AA0000' ? 'active' : '' }}" data-color="#AA0000" style="background-color: #AA0000;">
                            <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                        </div>
                        <div class="color-swatch {{ old('icon_color', $category->icon_color) == '#AA007D' ? 'active' : '' }}" data-color="#AA007D" style="background-color: #AA007D;">
                            <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                        </div>
                    </div>
                    {{-- Hidden input to store the selected color hex code --}}
                    <input type="hidden" name="icon_color" id="selectedColor" value="{{ old('icon_color', $category->icon_color) }}">
                    @error('icon_color')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary btn-add-category text-white">Save Changes</button>
                </div>

            </form>
        </div>
    </div>
</div>

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

        // Get the current value from the hidden input if available (for re-populating after validation error)
        const currentSelectedIconFilename = selectedIconInput.value;
        const currentSelectedColor = selectedColorInput.value;
        const currentSelectedIconBw = selectedIconBwInput.value;


        if (!activeIconBox || !activeColorSwatch) {
            // This block handles the initial load where `old()` might not have values,
            // or if an error causes a redirect back with no active classes set.
            // It uses the values from the $category object passed to the view.

            // Set default values based on the existing category if no active found
            const initialIconBaseName = "{{ $categoryIconBaseName }}"; // From PHP for initial load
            const initialColor = "{{ $category->icon_color }}";
            const initialIcon = "{{ $category->icon }}";

            selectedIconInput.value = initialIcon;
            selectedColorInput.value = initialColor;
            selectedIconBwInput.value = initialIconBaseName;

            previewIcon.src = `{{ asset('assets/images/') }}${initialIcon}`;
            previewNameSpan.style.color = initialColor;
        } else {
            // Logic for when active iconBox and colorSwatch are found (user interaction)
            const baseIconSrc = activeIconBox.dataset.fullIconPath;
            const pathParts = baseIconSrc.split('/');
            pathParts.pop();
            const imageBasePath = pathParts.join('/');

            const iconKey = activeIconBox.dataset.iconSrc.replace('.png', '');
            const colorKey = activeColorSwatch.dataset.color;

            previewNameSpan.style.color = colorKey;
            selectedColorInput.value = colorKey;
            selectedIconBwInput.value = activeIconBox.dataset.iconSrc;

            const newIconFilename = iconColorMap[iconKey]?.[colorKey];

            if (newIconFilename) {
                previewIcon.src = `${imageBasePath}/${newIconFilename}`;
                selectedIconInput.value = newIconFilename;
            } else {
                previewIcon.src = baseIconSrc;
                selectedIconInput.value = activeIconBox.dataset.iconSrc;
            }
        }

        // Update preview name text based on input field
        const newName = categoryNameInput.value;
        previewNameSpan.textContent = newName ? newName : 'Category';
    }

    // --- EVENT LISTENER FOR CATEGORY NAME INPUT ---
    categoryNameInput.addEventListener('input', function() {
        const newName = categoryNameInput.value;
        previewNameSpan.textContent = newName ? newName : 'Category';
    });

    // --- EVENT LISTENER FOR ICON SELECTION ---
    iconBoxes.forEach(box => {
        box.addEventListener('click', function() {
            iconBoxes.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            updatePreview();
        });
    });

    // --- EVENT LISTENER FOR COLOR SELECTION ---
    colorSwatches.forEach(swatch => {
        swatch.addEventListener('click', function() {
            colorSwatches.forEach(s => s.classList.remove('active'));
            this.classList.add('active');
            updatePreview();
        });
    });

    // Handle form submission: Ensure at least one icon and color are active
    const form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        if (!document.querySelector('.icon-box.active')) {
            alert('Please select an icon for your category.');
            event.preventDefault(); // Stop form submission
            return;
        }
        if (!document.querySelector('.color-swatch.active')) {
            alert('Please select a color for your category.');
            event.preventDefault(); // Stop form submission
            return;
        }
    });

    // Set initial active states for icons and colors based on the category data or old input
    const initialIconBw = '{{ old('icon_src_bw', $categoryIconBaseName) }}';
    const initialColor = '{{ old('icon_color', $category->icon_color) }}';

    iconBoxes.forEach(box => {
        if (box.dataset.iconSrc === initialIconBw) {
            box.classList.add('active');
        }
    });

    colorSwatches.forEach(swatch => {
        if (swatch.dataset.color === initialColor) {
            swatch.classList.add('active');
        }
    });

    // Call updatePreview() on initial load to set correct preview and hidden input values
    updatePreview();
});
</script>

@endsection
