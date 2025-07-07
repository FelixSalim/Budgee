<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    <img class="bi me-2 rounded-circle" width="70" height="70" src="{{ asset('assets/images/logo.jpg') }}" style="object-fit:cover;">
    <span class="fs-3 ms-2" style="color: #767676 !important;">Budgee</span>
</a>
<hr>
<ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item my-2">
        <a href="/" class="nav-link {{ Request::is('/') ? 'active' : 'link-dark' }}" aria-current="page">
            <svg class="bi me-2" width="24" height="24"><use width="24" height="24" xlink:href="{{ asset('assets/icons/house-door-fill.svg') }}"></use></svg>
            Dashboard
        </a>
    </li>
    <li class="nav-item my-2">
        <a href="/transactions" class="nav-link {{ Request::is('transactions') ? 'active' : 'link-dark' }}">
            <svg class="bi me-2" width="24" height="24"><use width="24" height="24" xlink:href="{{ asset('assets/icons/arrow-left-right.svg') }}"></use></svg>
            Transaction
        </a>
    </li>
    <li>
        <a href="/goalslist" class="nav-link {{ Request::is('goalslist') ? 'active' : 'link-dark' }}">
            <svg class="bi me-2" width="24" height="24"><use xlink:href="{{ asset('assets/icons/bullseye.svg') }}"></use></svg>
            Goals
        </a>
    </li>
    <li class="nav-item my-2">
        <a href="/regularpayment" class="nav-link {{ Request::is('regularpayment') ? 'active' : 'link-dark' }}">
            <svg class="bi me-2" width="24" height="24"><use width="24" height="24" xlink:href="{{ asset('assets/icons/wallet-fill.svg') }}"></use></svg>
            Regular Payment
        </a>
    </li>
    <li class="nav-item my-2">
        <a href="/categories" class="nav-link {{ Request::is('categories') ? 'active' : 'link-dark' }}">
            <svg class="bi me-2" width="24" height="24"><use width="24" height="24" xlink:href="{{ asset('assets/icons/archive-fill.svg') }}"></use></svg>
            Categories
        </a>
    </li>
    <li class="nav-item my-2">
        <a href="/profile" class="nav-link {{ Request::is('profile') ? 'active' : 'link-dark' }}">
            <svg class="bi me-2" width="24" height="24"><use width="24" height="24" xlink:href="{{ asset('assets/icons/person-fill.svg') }}"></use></svg>
            Profile
        </a>
    </li>
</ul>
<hr>
