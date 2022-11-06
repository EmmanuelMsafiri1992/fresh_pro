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
                <li class="nav-header text-bold">{{ __('Retailer') }}</li>
                <li class="nav-item">
                    <a href=""
                        class="nav-link  {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>{{ __('Users') }}</p>
                        </a>
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
                        <li  class="nav-item has-treeview ">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>
                                    {{ __('Shopkeepers') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href=""
                                       class="nav-link {{ request()->is('shop/superadmins/shopkeepers') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-tools"></i>
                                        <p>{{ __('View Shopkeepers') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('superadmins.shopkeepers.create')}}"
                                       class="nav-link {{ request()->is('shop/superadmins/shopkeepers/create') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-th-list"></i>
                                        <p>{{ __('Add Shopkeepers') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li  class="nav-item has-treeview ">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>
                                    {{ __('Catagory') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href="{{route('superadmins.categories.index')}}"
                                       class="nav-link {{ request()->is('shop/superadmins/categories') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-tools"></i>
                                        <p>{{ __('View Category') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('superadmins.categories.create')}}"
                                       class="nav-link {{ request()->is('shop/superadmins/categories/create') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-th-list"></i>
                                        <p>{{ __('Add Category') }}</p>
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
                        <li class="nav-header text-bold">{{ __('STOCK MANAGEMENT') }}</li>
                        <li class="nav-item">
                            <a href=""
                               class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>{{ __('Add Category') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                               class="nav-link ">
                                <i class="nav-icon fas fa-code-branch"></i>
                                <p>{{ __('Add Sub Category') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                               class="nav-link ">
                                <i class="nav-icon fas fa-code-branch"></i>
                                <p>{{ __('View Stock') }}</p>
                            </a>
                        </li>
                        <li class="nav-header text-bold">{{ __('EXPENSE MANAGEMENT') }}</li>
                        <li class="nav-item">
                            <a href=""
                               class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>{{ __('Add Category') }}</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href=""
                               class="nav-link">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>{{ __('Add Expense') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                               class="nav-link">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>{{ __('View Expense') }}</p>
                            </a>
                        </li>
                        <li class="nav-header text-bold">{{ __('SALES MANAGEMENT') }}</li>
                        <li class="nav-item">
                            <a href=""
                               class="nav-link ">
                                <i class="nav-icon fas fa-shopping-basket"></i>
                                <p>{{ __('Add Sales') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href=""
                               class="nav-link">
                                <i class="nav-icon fas fa-shopping-basket"></i>
                                <p>{{ __('View Sales') }}</p>
                            </a>
                        </li>
                        <li class="nav-header text-bold">{{ __('SUPPLIERS MANAGEMENT') }}</li>
                        <li class="nav-item">
                            <a href=""
                               class="nav-link {{ request()->is('admin/suppliers*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-people-carry"></i>
                                <p>{{ __('Add Supplier') }}</p>
                            </a>
                            <a href=""
                               class="nav-link">
                                <i class="nav-icon fas fa-people-carry"></i>
                                <p>{{ __('View Supplier') }}</p>
                            </a>
                        </li>
                        <li class="nav-header text-bold">{{ __('CLIENT MANAGEMENT') }}</li>
                        <li class="nav-item">
                            <a href=""
                               class="nav-link ">
                                <i class="nav-icon fas fa-people-carry"></i>
                                <p>{{ __('Add Client') }}</p>
                            </a>
                            <a href="pliers.index') }}"
                               class="nav-link">
                                <i class="nav-icon fas fa-people-carry"></i>
                                <p>{{ __('View Clients') }}</p>
                            </a>
                        </li>
                        <li class="nav-header text-bold">{{ __('DEBTORS MANAGEMENT') }}</li>
                        <li class="nav-item">
                            <a href=""
                               class="nav-link ">
                                <i class="nav-icon fas fa-people-carry"></i>
                                <p>{{ __('Add Debtor') }}</p>
                            </a>
                            <a href=""
                               class="nav-link">
                                <i class="nav-icon fas fa-people-carry"></i>
                                <p>{{ __('View Debtors') }}</p>
                            </a>
                        </li>
                        <li class="nav-header text-bold">{{ __('REPORT') }}</li>
                        <li class="nav-item">
                            <a href=""
                               class="nav-link {{ request()->is('admin/purchase-report') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-area"></i>
                                <p>{{ __('Sales Report') }}</p>
                            </a>
                        </li>
                        <li
                            class="nav-item has-treeview {{ request()->is('admin/processing-report') ? 'menu-open' : '' }} {{ request()->is('admin/finished-report') ? 'menu-open' : '' }} {{ request()->is('admin/transferred-report') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>
                                    {{ __('Stock Report') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href=""
                                       class="nav-link {{ request()->is('admin/processing-report') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-tools"></i>
                                        <p>{{ __('Processing') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href=""
                                       class="nav-link {{ request()->is('admin/finished-report') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-th-list"></i>
                                        <p>{{ __('Finished') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a
                                    class="nav-link {{ request()->is('admin/transferred-report') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-random"></i>
                                        <p>{{ __('Transferred') }}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header text-bold">{{ __('ACCOUNT') }}</li>
                        <li class="nav-item">
                            <a href="{{route('retailer.logout')}}" class="btn btn-danger w-100">
                                Logout
                            </a>
                        </li>
            </ul>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
