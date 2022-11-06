<aside class="main-sidebar elevation-4 @if (session('isSidebarDark')) sidebar-dark-primary @endif">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <!-- Large Device  -->
        @if(session()->get('isDark')== true || session()->get('isSidebarDark')== true )
            <img class="lg-logo" src="{{ $settings['darkLogo'] }}" alt="{{ $settings['compnayName'] }}">
            <!-- Small Device -->
            <img class="sm-logo" src="{{ $settings['smallDarkLogo'] }}" alt="{{ $settings['compnayName'] }}">
        @else

            <img class="lg-logo" src="{{ $settings['logo'] }}" alt="{{ $settings['compnayName'] }}">
            <!-- Small Device -->
            <img class="sm-logo" src="{{ $settings['smallLogo'] }}" alt="{{ $settings['compnayName'] }}">
        @endif

    </a>
    <!-- Sidebar -->
    <div class="sidebar custom-sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header text-bold">{{ __('Wholeseller') }}</li>
                <li class="nav-item">
                    <a href="{{route('wholeseller.dashboard')}}"
                       class="nav-link  {{ request()->is('wholeseller/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->is('shop/wholeseller/retailer') ? 'menu-open' : '' }} {{ request()->is('admin/finished-report') ? 'menu-open' : '' }} {{ request()->is('admin/transferred-report') ? 'menu-open' : '' }}">
                    <a href="{{route('wholeseller.retailers.index')}}" class="nav-link">
                <li  class="nav-item has-treeview {{ request()->is('shop/wholeseller/retailer') ? 'menu-open' : '' }} {{ request()->is('admin/finished-report') ? 'menu-open' : '' }} {{ request()->is('admin/transferred-report') ? 'menu-open' : '' }}">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            {{ __('Retailers') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('wholeseller.retailers.index')}}"
                               class="nav-link {{ request()->is('admin/processing-report') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>{{ __('View Retailers') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('wholeseller.retailers.create')}}"
                               class="nav-link {{ request()->is('admin/finished-report') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>{{ __('Add Retailer') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->is('admin/processing-report') ? 'menu-open' : '' }} {{ request()->is('admin/finished-report') ? 'menu-open' : '' }} {{ request()->is('admin/transferred-report') ? 'menu-open' : '' }}">
                    <a href="{{route('wholeseller.shops.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            {{ __('Shops') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('wholeseller.shops.index')}}"
                               class="nav-link {{ request()->is('admin/processing-report') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>{{ __('View Shops') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                               class="nav-link {{ request()->is('admin/finished-report') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>{{ __('Add Shop') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->is('admin/processing-report') ? 'menu-open' : '' }} {{ request()->is('admin/finished-report') ? 'menu-open' : '' }} {{ request()->is('admin/transferred-report') ? 'menu-open' : '' }}">
                    <a href="{{route('wholeseller.shopkeepers.index')}}}" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            {{ __('Shopkeeper') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('wholeseller.shopkeepers.index')}}"
                               class="nav-link {{ request()->is('admin/processing-report') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>{{ __('View Shopkeepers') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('wholeseller.shopkeepers.create')}}"
                               class="nav-link {{ request()->is('admin/finished-report') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>{{ __('Add Shopkeeper') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->is('admin/processing-report') ? 'menu-open' : '' }} {{ request()->is('admin/finished-report') ? 'menu-open' : '' }} {{ request()->is('admin/transferred-report') ? 'menu-open' : '' }}">
                    <a href="{{route('wholeseller.products.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            {{ __('Products') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('wholeseller.products.index')}}"
                               class="nav-link {{ request()->is('admin/processing-report') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>{{ __('View Products') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('wholeseller.products.create')}}"
                               class="nav-link {{ request()->is('admin/finished-report') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>{{ __('Add Product') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->is('admin/processing-report') ? 'menu-open' : '' }} {{ request()->is('admin/finished-report') ? 'menu-open' : '' }} {{ request()->is('admin/transferred-report') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            {{ __('Customers') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('wholeseller.customers.index')}}"
                               class="nav-link {{ request()->is('admin/processing-report') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>{{ __('View Customers') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('wholeseller.customers.create')}}"
                               class="nav-link {{ request()->is('admin/finished-report') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>{{ __('Add Customer') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ request()->is('admin/processing-report') ? 'menu-open' : '' }} {{ request()->is('admin/finished-report') ? 'menu-open' : '' }} {{ request()->is('admin/transferred-report') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            {{ __('Sale') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href=""
                               class="nav-link {{ request()->is('admin/processing-report') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>{{ __('View Sale') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                               class="nav-link {{ request()->is('admin/finished-report') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>{{ __('Add Sale') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header text-bold">{{ __('ACCOUNT') }}</li>
                <li class="nav-item">
                    <a href="{{route('wholeseller.logout')}}" class="btn btn-danger w-100">
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
