@if ($configData['mainLayoutType'] === 'horizontal' && isset($configData['mainLayoutType']))
    <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center {{ $configData['navbarColor'] }}"
        data-nav="brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <h2 class="brand-text mb-0">IRIS-SPA</h2>
                    </a>
                </li>
            </ul>
        </div>
    @else
        <nav class="header-navbar navbar navbar-expand-lg align-items-center {{ $configData['navbarClass'] }} navbar-light navbar-shadow {{ $configData['navbarColor'] }} {{ $configData['layoutWidth'] === 'boxed' && $configData['verticalMenuNavbarType'] === 'navbar-floating' ? 'container-xxl' : '' }}">
@endif

    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item">
                    <a class="nav-link menu-toggle" href="javascript:void(0);">
                        <i class="ficon" data-feather="menu"></i>
                    </a>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item dropdown dropdown-language">
                <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown"
                    aria-haspopup="true">
                    <i class="flag-icon flag-icon-us"></i>
                    <span class="selected-language">English</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
                    <a class="dropdown-item" href="{{ url('lang/en') }}" data-language="en">
                        <i class="flag-icon flag-icon-gb"></i> English
                    </a>
                    <a class="dropdown-item" href="{{ url('lang/ms') }}" data-language="ms">
                        <i class="flag-icon flag-icon-my"></i> Malay
                    </a>
                </div>
            </li>
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link nav-link-style">
                    <i class="ficon" data-feather="{{ $configData['theme'] === 'dark' ? 'sun' : 'moon' }}"></i>
                </a>
            </li>

            <li class="nav-item dropdown dropdown-user">
                <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">
                            @if (Auth::check())
                                {{ Auth::user()->name }}
                            @else
                                Fake User
                            @endif
                        </span>
                        <span class="user-status">
                            @if (Auth::check())
                                {{ ucwords(Auth::user()->getRolesDisplay()) }}
                            @else
                            Fake Role
                            @endif
                        </span>
                    </div>
                    <span class="avatar bg-light-secondary">
                        @php
                            $exp_username   = explode(' ',Auth::user()->name);
                            $short_name     = substr($exp_username[array_key_first($exp_username)],0,1);
                            if(count($exp_username) > 1){
                                $short_name = $short_name.''.substr($exp_username[array_key_last($exp_username)],0,1);
                            }
                        @endphp
                        <span class="avatar-content">{{ $short_name }}</span>
                        <span class="avatar-status-online"></span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="{{ route('user.show', Auth::user()->id) }}">
                        <i class="fa-regular fa-user me-50"></i>
                            Profile Information
                    </a>

                    <div class="dropdown-divider"></div>

                    @if (Auth::check())
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="me-50" data-feather="power"></i> 
                                Logout
                        </a>
                        <form method="POST" id="logout-form" action="{{ route('logout') }}">
                            @csrf
                        </form>
                    @else
                        <a class="dropdown-item" href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}">
                            <i class="me-50" data-feather="log-in"></i> 
                                Login
                        </a>
                    @endif
                </div>
            </li>
        </ul>
    </div>
</nav>
