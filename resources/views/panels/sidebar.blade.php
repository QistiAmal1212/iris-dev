@php
$configData = Helper::applClasses();
@endphp
<div class="main-menu menu-fixed {{ $configData['theme'] === 'dark' || $configData['theme'] === 'semi-dark' ? 'menu-dark' : 'menu-light' }} menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h2 class="brand-text text-uppercase">IRIS - SPA</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>

    <div class="shadow-bottom"></div>

    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item {{ in_array(request()->route()->getName(), ['home']) ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="d-flex align-items-center">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate">{{__('msg.home')}} </span>
                </a>
            </li>

            {{-- FMF MODULE HERE: CLOSED FOR LOGIN MODULE REVIEW  --}}
            {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                    <i data-feather="user"></i>
                    <span class="menu-title text-truncate"> {{__('msg.testForm')}} </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ in_array(request()->route()->getName(), ['testForm.index']) ? 'active' : '' }}">
                        <a href="{{ route('testForm.index')}}" class="d-flex align-items-center">
                            <i data-feather="circle"></i> <span class="menu-title text-truncate"> {{__('msg.form')}} </span>
                        </a>
                    </li>
                    <li class="{{ in_array(request()->route()->getName(), ['testForm.list']) ? 'active' : '' }}">
                        <a href="{{ route('testForm.list')}}" class="d-flex align-items-center">
                            <i data-feather="circle"></i> <span class="menu-title text-truncate"> {{__('msg.list')}} </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" >
                    <i class="fa-regular fa-folder"></i>
                    <span class="menu-title text-truncate"> {{__('msg.testFormNoFMF') }}  </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ in_array(request()->route()->getName(), ['testFormNoFMF.createForm','testFormNoFMF.viewForm']) ? 'active' : '' }} ">
                        <a href="{{ route('testFormNoFMF.createForm')}}" class="d-flex align-items-center">
                            <i class="fa-solid fa-file-circle-plus"></i>
                            <span class="menu-title text-truncate"> {{__('msg.customCreate',['item' => __('msg.form')])}} </span>
                        </a>
                    </li>
                    <li class="{{ in_array(request()->route()->getName(), ['testFormNoFMF.listTestForm']) ? 'active' : '' }}">
                        <a href="{{ route('testFormNoFMF.listTestForm')}}" class="d-flex align-items-center">
                            <i class="fa-solid fa-list"></i>
                            <span class="menu-title text-truncate"> {{__('msg.customList',['item' => __('msg.form')])}} </span>
                        </a>
                    </li>
                </ul>
            </li> --}}

            {{-- @hasanyrole('superadmin|admin')
                <li class="nav-item {{ in_array(request()->route()->getName(), ['statistics']) ? 'menu-open' : '' }}">
                    <a href="{{ route('statistics') }}" class="nav-link {{ in_array(request()->route()->getName(), ['statistics']) ? 'active' : '' }}">
                        <i data-feather="pie-chart"></i>
                        <span class="menu-title text-truncate"> {{__('msg.statistics')}} </span>
                    </a>
                </li>
            @endhasanyrole --}}

            {{-- @hasanyrole('superadmin|admin')
                <li class="navigation-header">
                    <span> User Settings </span>
                </li>
                <li class="nav-item {{ request()->is('admin/user*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i data-feather="user"></i>
                        <span class="menu-title text-truncate"> {{__('msg.user_management')}} </span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-user-internal {{ in_array(request()->route()->getName(),['admin.internalUser'])? 'active': '' }}">
                            <a href="{{ route('admin.internalUser') }}" class="d-flex align-items-center">
                                <i data-feather="circle"></i>
                                <span class="menu-title text-truncate">
                                    {{ __('msg.userinternal') }}
                                </span>
                            </a>
                        </li>
                        <li class="nav-user-external {{ in_array(request()->route()->getName(),['admin.externalUser'])? 'active': '' }}">
                            <a href="{{ route('admin.externalUser') }}" class="d-flex align-items-center">
                                <i data-feather="circle"></i>
                                <span class="menu-title text-truncate">
                                    {{ __('msg.userexternal') }}
                                </span>
                            </a>
                        </li>
                        <li class="{{ in_array(request()->route()->getName(), ['role.index']) ? 'active' : '' }}">
                            <a href="{{ route('role.index') }}" class="d-flex align-items-center">
                                <i data-feather="circle"></i> <span class="menu-title text-truncate"> Pengurusan Peranan </span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endhasanyrole --}}

            @hasanyrole('superadmin|admin')
                <li class="navigation-header">
                    <span> Pengurusan </span>
                </li>
                <li class="nav-item {{ request()->is('admin/user*') || request()->is('admin/role*') || request()->is('admin/security*') || request()->is('admin/log*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i data-feather="settings"></i>
                        <span class="menu-title text-truncate">Pengurusan Sistem</span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i data-feather="database"></i>
                                <span class="menu-title text-truncate">Pengurusan Data</span>
                            </a>
                            <ul class="menu-content">
                                <li class="">
                                    <a href="#" class="d-flex align-items-center">
                                        <i data-feather="circle"></i>
                                        <span class="menu-title text-truncate">
                                            Pelbagai
                                        </span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#" class="d-flex align-items-center">
                                        <i data-feather="circle"></i>
                                        <span class="menu-title text-truncate">
                                            Calon
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ request()->is('admin/user*') || request()->is('admin/role*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i data-feather="users"></i>
                                <span class="menu-title text-truncate">Pengurusan Pengguna</span>
                            </a>
                            <ul class="menu-content">
                                <li class="{{ in_array(request()->route()->getName(),['admin.internalUser'])? 'active': '' }}">
                                    <a href="{{ route('admin.internalUser') }}" class="d-flex align-items-center">
                                        <i data-feather="circle"></i>
                                        <span class="menu-title text-truncate">
                                            Pengguna
                                        </span>
                                    </a>
                                </li>
                                <li class="{{ in_array(request()->route()->getName(),['role.index'])? 'active': '' }}">
                                    <a href="{{ route('role.index') }}" class="d-flex align-items-center">
                                        <i data-feather="circle"></i>
                                        <span class="menu-title text-truncate">
                                            Role
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ request()->is('admin/security*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i data-feather="shield"></i>
                                <span class="menu-title text-truncate">Pengurusan Keselamatan</span>
                            </a>
                            <ul class="menu-content">
                                <li class="{{ in_array(request()->route()->getName(), ['admin.security.menu']) ? 'active': '' }}">
                                    <a href="{{ route('admin.security.menu') }}" class="d-flex align-items-center">
                                        <i data-feather="circle"></i>
                                        <span class="menu-title text-truncate">
                                            Selenggara Menu
                                        </span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#" class="d-flex align-items-center">
                                        <i data-feather="circle"></i>
                                        <span class="menu-title text-truncate">
                                            Selenggara Capaian
                                        </span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#" class="d-flex align-items-center">
                                        <i data-feather="circle"></i>
                                        <span class="menu-title text-truncate">
                                            Selenggara Turutan
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ in_array(request()->route()->getName(),['admin.log']) ? 'active' : '' }}">
                            <a href="{{ route('admin.log') }}">
                                <i data-feather="file-text"></i>
                                <span class="menu-title text-truncate">Transaksi Pengguna</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endhasanyrole

            {{-- @hasanyrole('superadmin|admin')
                @php
                $securityMenu = App\Models\SecurityMenu::where('level', 1)->get();
                @endphp
                @foreach($securityMenu as $menu)
                    <li class="nav_item {{ ($menu->type == 'Web') ? in_array(request()->route()->getName(), [$menu->module->code]) ? 'active' : '' : '#' }}">
                        <a href="{{ ($menu->type == 'Web') ? route($menu->module->code) : '#' }}" class="nav_link">
                            <!-- <i data-feather="circle"></i> -->
                             <span class="menu-title text-truncate">{{ $menu->name }}</span>
                        </a>
                        @if($menu->type == 'Menu')
                        <ul class="menu-content">
                            @php
                            $level2 = App\Models\SecurityMenu::where('level', 2)->where('menu_link', $menu->id)->get();
                            @endphp
                            @foreach($level2 as $menu2)
                            <li class="nav-item {{ ($menu2->type == 'Web') ? in_array(request()->route()->getName(), [$menu2->module->code]) ? 'active' : '' : '#' }}"> 
                                <a href="{{ ($menu2->type == 'Web') ? route($menu2->module->code) : '#' }}" class="nav-link">
                                    <!-- <i data-feather="shield"></i> -->
                                    <span class="menu-title text-truncate">{{ $menu2->name }}</span>
                                </a>
                                @if($menu2->type == 'Menu')
                                <ul class="menu-content">
                                    @php
                                    $level3 = App\Models\SecurityMenu::where('level', 3)->where('menu_link', $menu2->id)->get();
                                    @endphp
                                    @foreach($level3 as $menu3)
                                    <li class="nav-item {{ ($menu3->type == 'Web') ? in_array(request()->route()->getName(), [$menu3->module->code]) ? 'active' : '' : '#' }}">
                                        <a href="{{ ($menu3->type == 'Web') ? route($menu3->module->code) : '#' }}" class="d-flex align-items-center">
                                            <!-- <i data-feather="circle"></i> -->
                                            <span class="menu-title text-truncate">{{ $menu3->name }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                @endforeach
            @endhasanyrole --}}

            {{-- @hasanyrole('superadmin')
                <li class="navigation-header">
                    <span> System Settings </span>
                </li>
                <li class="nav-item {{ request()->is('admin/settings*') || request()->is('admin/log*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i data-feather="settings"></i>
                        <span class="menu-title text-truncate"> {{__('msg.system_management')}} </span>
                    </a>
                    <ul class="menu-content">
                        @if(\Composer\InstalledVersions::isInstalled('developer-unijaya/flow-management-function'))
                        <li class="{{ in_array(request()->route()->getName(), ['module.index']) ? 'active' : '' }}">
                            <a href="{{ route('module.index') }}" class="d-flex align-items-center">
                                <i data-feather="circle"></i> <span class="menu-title text-truncate"> {{ __('msg.module_config') }} </span>
                            </a>
                        </li>
                        @endif
                        <li class="{{ in_array(request()->route()->getName(), ['settings.index']) ? 'active' : '' }}">
                            <a href="{{ route('settings.index') }}" class="d-flex align-items-center">
                                <i data-feather="circle"></i> <span class="menu-title text-truncate"> {{ __('msg.system_config') }} </span>
                            </a>
                        </li>
                        <li class="{{ in_array(request()->route()->getName(), ['admin.log']) ? 'active' : '' }}">
                            <a href="{{ route('admin.log') }}" class="d-flex align-items-center">
                                <i data-feather="circle"></i> <span class="menu-title text-truncate"> Jejak Audit / Log </span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endhasanyrole --}}

            {{-- HELPDESK MODULE HERE  --}}
            {{-- @if(\Composer\InstalledVersions::isInstalled('developer-unijaya/quickstart-helpdesk'))
                <li class="navigation-header">
                    <span>Helpdesk</span>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-headset"></i>
                        <span class="menu-title text-truncate"> Helpdesk </span>
                    </a>
                    <ul class="menu-content">
                        <li class="{{ in_array(request()->route()->getName(), ['helpdesk.index','helpdesk.viewTicket']) ? 'active' : '' }}" >
                            <a href="{{ route('helpdesk.index') }}" class="nav-link">
                                <i class="fa-solid fa-list"></i>
                                <span class="menu-title text-truncate"> Senarai </span>
                            </a>
                        </li>
                    @hasanyrole('superadmin')
                        <li class="{{ in_array(request()->route()->getName(), ['helpdesk.categoryList']) ? 'active' : '' }}" >
                            <a href="{{ route('helpdesk.categoryList') }}" class="nav-link">
                                <i class="fa-solid fa-gear"></i>
                                <span class="menu-title text-truncate"> Pengurusan </span>
                            </a>
                        </li>
                    @endhasanyrole
                    </ul>
                </li>
            @endif --}}

            {{-- IRIS MODULE PEMOHON --}}
            <li class="navigation-header">
                    <span> Maklumat Pemohon </span>
                </li>
                <li class="nav-item {{ request()->is('iris/maklumat-pemohon*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-users-line"></i>
                        <span class="menu-title text-truncate"> Pemohon </span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-user-internal {{ in_array(request()->route()->getName(),['carian_pemohon'])? 'active': '' }}">
                            <a href="{{ route('carian_pemohon') }}" class="d-flex align-items-center">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <span class="menu-title text-truncate">
                                    Carian Pemohon
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

            {{-- Foreach documentation menu item starts --}}
            @hasanyrole('')
                @if (!in_array(env('APP_ENV'),['production','staging']))
                    <hr>
                    <li class="navigation-header">
                        <span>Documentation Side</span>
                        <i data-feather="more-horizontal"></i>
                    </li>
                    @if (isset($menuData[0]))
                        @foreach ($menuData[0]->menu as $menu)
                            @if (isset($menu->navheader))
                                <li class="navigation-header">
                                    <span>{{ __('locale.' . $menu->navheader) }}</span>
                                    <i data-feather="more-horizontal"></i>
                                </li>
                            @else
                                {{-- Add Custom Class with nav-item --}}
                                @php
                                $custom_classes = '';
                                if (isset($menu->classlist)) {
                                    $custom_classes = $menu->classlist;
                                }
                                @endphp
                                <li class="nav-item {{ $custom_classes }} {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }}">
                                    <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}" class="d-flex align-items-center" target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                                        <i data-feather="{{ $menu->icon }}"></i>
                                        <span class="menu-title text-truncate">{{ __('locale.' . $menu->name) }}</span>
                                        @if (isset($menu->badge))
                                            <?php $badgeClasses = 'badge rounded-pill badge-light-primary ms-auto me-1'; ?>
                                            <span class="{{ isset($menu->badgeClass) ? $menu->badgeClass : $badgeClasses }}">{{ $menu->badge }}</span>
                                        @endif
                                    </a>
                                    @if (isset($menu->submenu))
                                        @include('panels/submenu', ['menu' => $menu->submenu])
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endif
            @endhasanyrole
        </ul>
    </div>
</div>
