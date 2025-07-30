@extends('layout.template')
@section('title', 'Add Transaction')
@section('extra-css')
    <link rel="stylesheet" href="{{ asset('assets/css/newtransaction.css') }}">
@endsection
@section('content')
    <div class="container py-5 px-4">
        <div class="top-bar">
            <h4><a href="{{ route('transactions') }}"><i class="bi bi-arrow-left me-2"></i></a> Add Transaction</h4>
            <div class="d-flex align-items-center">
                {{-- Button showing the current date --}}
                <button type="button" id="dateBtn" class="btn-today d-flex justify-content-center align-items-center">
                    <img width="30" height="30" src="{{ asset('assets/images/date-icon.png') }}" class="mx-2">
                    {{ date('d M Y') }}
                </button>
            </div>
        </div>
        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
            
            {{-- Hidden input for transaction date --}}
            <input type="hidden" name="transaction_date" id="transaction_date" value="{{ date('Y-m-d') }}">
            
            <div class="mb-5">
                <div class="d-flex align-items-center gap-3">
                    <input type="text" name="amount" class="custom-input w-25" placeholder="0">
                    <span class="fw-medium text-primary">{{ Auth::user()->currency }}</span>
                    <div class="form-check form-check-inline mx-5 ps-5">
                        <input class="form-check-input me-2" type="radio" name="type" id="expense" value="expense" checked>
                        <label class="form-check-label" for="expense">Expenses</label>
                    </div>
                    <div class="form-check form-check-inline mx-3">
                        <input class="form-check-input me-2" type="radio" name="type" id="income" value="income">
                        <label class="form-check-label" for="income">Income</label>
                    </div>
                </div>
            </div>
            <div class="form-section my-5">
                <label class="form-label my-3">Categories</label>
                <div id="category-grid" class="category-grid mt-2">
                    {{-- Default: Expense Categories --}}
                    @foreach($expenses as $category)
                        <div class="category-box" data-category-id="{{ $category->id }}">
                            <img src="{{ asset('assets/images/' . $category->icon . '/' . $category->icon_color) }}" alt="{{ $category->name }}">
                            <div class="category-label">{{ $category->name }}</div>
                        </div>
                    @endforeach
                    <a href="{{ route('newcategory') }}">
                        <div class="category-box text-muted">
                            <div class="fs-2">+</div>
                            <div class="category-label">New Category</div>
                        </div>
                    </a>
                </div>

                {{-- Hidden templates --}}
                <template id="expense-template">
                    @foreach($expenses as $category)
                        <div class="category-box" data-category-id="{{ $category->id }}">
                            <img src="{{ asset('assets/images/' . $category->icon . '/' . $category->icon_color) }}" alt="{{ $category->name }}">
                            <div class="category-label">{{ $category->name }}</div>
                        </div>
                    @endforeach
                    <a href="{{ route('newcategory') }}">
                        <div class="category-box text-muted">
                            <div class="fs-2">+</div>
                            <div class="category-label">New Category</div>
                        </div>
                    </a>
                </template>

                <template id="income-template">
                    @foreach($income as $category)
                        <div class="category-box" data-category-id="{{ $category->id }}">
                            <img src="{{ asset('assets/images/' . $category->icon . '/' . $category->icon_color) }}" alt="{{ $category->name }}">
                            <div class="category-label">{{ $category->name }}</div>
                        </div>
                    @endforeach
                    <a href="{{ route('newcategory') }}">
                        <div class="category-box text-muted">
                            <div class="fs-2">+</div>
                            <div class="category-label">New Category</div>
                        </div>
                    </a>
                </template>
            </div>

            {{-- Hidden input for selected category --}}
            <input type="hidden" name="category_id" id="selectedCategory">

            <div class="form-section my-5">
                <label for="desc" class="form-label my-3">Description</label>
                <input type="text" name="description" id="desc" class="custom-input" placeholder="Description">
            </div>

            <div class="d-flex w-100 justify-content-center mt-5">
                <button type="submit" class="btn btn-primary rounded-4 mt-3">Add Transaction</button>
            </div>
        </form>
    </div>
@endsection

@section('extra-script')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const expenseTemplate = document.querySelector("#expense-template").innerHTML;
            const incomeTemplate = document.querySelector("#income-template").innerHTML;
            const categoryGrid = document.querySelector("#category-grid");
            const selectedCategoryInput = document.querySelector("#selectedCategory");

            // Function to attach click listeners to category boxes
            function attachCategoryEvents() {
                document.querySelectorAll(".category-box").forEach(box => {
                    box.addEventListener("click", function () {
                        document.querySelectorAll(".category-box").forEach(b => b.classList.remove("selected"));
                        this.classList.add("selected");
                        selectedCategoryInput.value = this.dataset.categoryId || "";
                    });
                });
            }

            // Initial click binding
            attachCategoryEvents();

            // Listen to radio button changes
            document.querySelectorAll("input[name='type']").forEach(radio => {
                radio.addEventListener("change", function () {
                    if (this.value === "expense") {
                        categoryGrid.innerHTML = expenseTemplate;
                    } else {
                        categoryGrid.innerHTML = incomeTemplate;
                    }
                    setLabelColors();
                    setIconColors();
                    attachCategoryEvents();
                });
            });

            const dateInput = document.querySelector("#transaction_date");
            const dateBtn = document.querySelector("#dateBtn");

            // Initialize Flatpickr but don't show it immediately
            const picker = flatpickr(dateBtn, {
                defaultDate: dateInput.value,
                maxDate: "today", // Prevent future dates
                dateFormat: "Y-m-d",
                position: "below", // Ensures it appears below button
                onChange: function (selectedDates, dateStr) {
                    // Update hidden input for form submission
                    dateInput.value = dateStr;

                    // Update button label
                    const formatted = selectedDates[0].toLocaleDateString('en-GB', {
                        day: 'numeric', month: 'short', year: 'numeric'
                    });
                    dateBtn.innerHTML = `<img width="30" height="30" src="/assets/images/date-icon.png" class="mx-2">${formatted}`;
                }
            });

            // Open picker on button click
            dateBtn.addEventListener("click", function () {
                picker.open();
            });
        });


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

        // Function to set icon colors based on the mapping
        function setIconColors() {
            document.querySelectorAll('.category-box img').forEach(img => {
                var iconType, iconColor;
                var srcParts = img.src.split('/');
                iconType = srcParts[srcParts.length - 2].split('.')[0] + "bw"; // Get the icon type from the URL
                iconColor = srcParts[srcParts.length - 1];
                var color = iconColorMap[iconType][iconColor]
                if (color) {
                    img.src = "{{ asset('assets/images/') }}/" + color; // Update the image source
                } else {
                    console.warn(`No color mapping found for ${iconType} with color ${iconColor}`);
                }
            });
        }

        function setLabelColors() {
            document.querySelectorAll('.category-box').forEach(box => {
                var label = box.querySelector('.category-label');
                var icon = box.querySelector('img');
                if (icon && label) {
                    var iconColor = icon.src.split('/').pop(); // Get the color from the image URL
                    label.style.color = iconColor; // Set the label color to match the icon color
                } else {
                    label.style.color = '#767676'; // Default color for new category
                }
            });
        }

        setLabelColors();
        setIconColors();
    </script>
@endsection