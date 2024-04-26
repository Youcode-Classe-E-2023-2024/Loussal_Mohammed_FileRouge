<nav id="sidebar">

    <div class="navbar-nav theme-brand flex-row  text-center">
        <div class="nav-logo">

            <div class="nav-item theme-text">
                <a href="{{route('dashboard')}}" class="nav-link"> Crypto </a>
            </div>
        </div>
        <div class="nav-item sidebar-toggle">
            <div class="btn-toggle sidebarCollapse">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="feather feather-chevrons-left">
                    <polyline points="11 17 6 12 11 7"></polyline>
                    <polyline points="18 17 13 12 18 7"></polyline>
                </svg>
            </div>
        </div>
    </div>
    <div class="profile-info">
        <div class="user-info">
            <div class="profile-img">
                <img src="{{asset('images/avatar.jpeg')}}" alt="avatar">
                <p>Digital Money is real </p>
            </div>
            <div class="profile-content">
                <h6 class="" id='user'></h6>
                <p class="" id='roles'></p>
            </div>
        </div>
    </div>

    <div class="shadow-bottom"></div>
    <ul class="list-unstyled menu-categories" id="accordionExample">
        <li class="menu active">
            <a href="#dashboard" data-bs-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span>Dashboard</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-chevron-right">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled show" id="dashboard"
                data-bs-parent="#accordionExample">
                <li class="{{ request()->is('markets') ? 'active' : '' }}">
                    <a href="/markets"> Markets </a>
                </li>
                <li class="{{ request()->is('assets') ? 'active' : '' }}">
                    <a href="/assets"> Assets </a>
                </li>
                <li class="{{ request()->is('exchanges') ? 'active' : '' }}">
                    <a href="/exchanges"> Exchanges </a>
                </li>
                <li>
                    @if(Auth::check())
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf <!-- Include CSRF token for security -->
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                    @else()
                        <a href="{{ route('login') }}" }> Login </a>
                    @endif
                </li>
            </ul>
        </li>


    </ul>

</nav>
