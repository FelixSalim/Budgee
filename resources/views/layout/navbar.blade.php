<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    <img class="bi me-2 rounded-circle" width="70" height="70" src="{{ asset('assets/images/logo.jpg') }}" style="object-fit:cover;">
    <span class="fs-3 ms-2" style="color: #767676 !important;">Budgee</span>
</a>
<hr>
<style>
    .nav-pills .nav-link.active {
        background-color: #005cab !important; /* Custom blue */
        color: #fff !important;
    }
    .nav-pills .nav-link {
        color: #767676 !important;
        font-size: 1.25rem !important; /* Make text bigger */
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: none !important;
        transition: color 0.2s, opacity 0.2s;
    }
    .nav-pills .nav-link .bi,
    .nav-pills .nav-link svg {
        width: 24px !important;
        height: 24px !important;
        margin-right: 0.5rem;
        vertical-align: middle;
        transition: fill 0.2s;
    }
    .nav-pills .nav-link.active,
    .nav-pills .nav-link.active .bi,
    .nav-pills .nav-link.active svg {
        color: #005cab !important; /* Blue text and icon */
        fill: #005cab !important;
        opacity: 1 !important;
    }
    .nav-pills .nav-link.active {
        background: none !important; /* Remove background */
    }
</style>
<ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
        <a href="/" class="nav-link {{ Request::is('/') ? 'active' : 'link-dark' }}" aria-current="page">
            <svg class="bi me-2" width="24" height="24"><use xlink:href="{{ asset('assets/icons/house-door-fill.svg') }}"></use></svg>
            Dashboard
        </a>
    </li>
    <li>
        <a href="/transaction" class="nav-link {{ Request::is('transaction') ? 'active' : 'link-dark' }}">
            <svg class="bi me-2" width="24" height="24"><use xlink:href="{{ asset('assets/icons/arrow-left-right.svg') }}"></use></svg>
            Transaction
        </a>
    </li>
    <li>
        <a href="/goalslist" class="nav-link {{ Request::is('goalslist') ? 'active' : 'link-dark' }}">
            <svg class="bi me-2" width="24" height="24"><use xlink:href="{{ asset('assets/icons/bullseye.svg') }}"></use></svg>
            Goals
        </a>
    </li>
    <li>
        <a href="/regularpayment" class="nav-link {{ Request::is('regularpayment') ? 'active' : 'link-dark' }}">
            <svg class="bi me-2" width="24" height="24"><use xlink:href="{{ asset('assets/icons/wallet-fill.svg') }}"></use></svg>
            Regular Payment
        </a>
    </li>
    <li>
        <a href="/categories" class="nav-link {{ Request::is('categories') ? 'active' : 'link-dark' }}">
            <svg class="bi me-2" width="24" height="24"><use xlink:href="{{ asset('assets/icons/archive-fill.svg') }}"></use></svg>
            Categories
        </a>
    </li>
    <li>
        <a href="/profile" class="nav-link {{ Request::is('profile') ? 'active' : 'link-dark' }}">
            <svg class="bi me-2" width="24" height="24"><use xlink:href="{{ asset('assets/icons/person-fill.svg') }}"></use></svg>
            Profile
        </a>
    </li>
</ul>
<hr>
{{-- <div class="dropdown">
    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
    <strong>mdo</strong>
    </a>
    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
    </ul>
</div> --}}
