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
                <li class="nav-header text-bold">{{ __('ACTIVITY') }}</li>
                <li class="nav-item">
                    <a href="{{route('superadmin.dashboard')}}"
                       class="nav-link  {{ request()->is('shop/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>{{ __('Super Admin Dashboard') }}</p>
                    </a>
                </li>
                <li  class="nav-item has-treeview ">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            {{ __('Admins') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('superadmins.admins.index')}}"
                               class="nav-link {{ request()->is('shop/superadmins/admins') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>{{ __('View Admins') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('superadmins.admins.create')}}"
                               class="nav-link {{ request()->is('shop/superadmins/admins/create') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>{{ __('Add Admin') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li  class="nav-item has-treeview ">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            {{ __('Wholesellers') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('superadmins.wholesellers.index')}}"
                               class="nav-link {{ request()->is('shop/superadmins/wholesellers') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>{{ __('View Wholesellers') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('superadmins.wholesellers.create')}}"
                               class="nav-link {{ request()->is('shop/superadmins/wholesellers/create') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>{{ __('Add Wholeseller') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li  class="nav-item has-treeview ">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            {{ __('Retailers') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('superadmins.retailers.index')}}"
                               class="nav-link {{ request()->is('shop/superadmins/retailers') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>{{ __('View Retailers') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('superadmins.retailers.create')}}"
                               class="nav-link {{ request()->is('shop/superadmins/retailers/create') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>{{ __('Add Retailer') }}</p>
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
                            <a href="{{route('superadmins.shopkeepers.index')}}"
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
                            {{ __('Customers') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('superadmins.customers.index')}}"
                               class="nav-link {{ request()->is('shop/superadmins/customers') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>{{ __('View Customers') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('superadmins.customers.create')}}"
                               class="nav-link {{ request()->is('shop/superadmins/customers/create') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>{{ __('Add Customers') }}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li  class="nav-item has-treeview ">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            {{ __('Shops') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('superadmins.shops.index')}}"
                               class="nav-link {{ request()->is('shop/superadmins/shops') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>{{ __('View Shops') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('superadmins.shops.create')}}"
                               class="nav-link {{ request()->is('shop/superadmins/shops/create') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>{{ __('Add Shops') }}</p>
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
                <li  class="nav-item has-treeview ">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            {{ __('Products') }}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li class="nav-item">
                            <a href="{{route('superadmins.products.index')}}"
                               class="nav-link {{ request()->is('shop/superadmins/products') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tools"></i>
                                <p>{{ __('View Products') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('superadmins.products.create')}}"
                               class="nav-link {{ request()->is('shop/superadmins/products/create') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>{{ __('Add Product') }}</p>
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
                <!-- <li class="nav-item">
                    <a href=""
                        class="nav-link">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>{{ __('Processing') }}</p>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href=""
                        class="nav-link">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>{{ __('Finished') }}</p>
                    </a>
                </li> -->
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
                <!-- <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('admin/return-purchases*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-undo-alt"></i>
                        <p>{{ __('Return Purchases') }}</p>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('admin/damage-purchases*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-trash-alt"></i>
                        <p>{{ __('Damage Purchases') }}</p>
                    </a>
                </li> -->

                <!-- <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('admin/purchase-inventory*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>{{ __('Purchase Inventory') }}</p>
                    </a>
                </li> -->

                <!-- <li class="nav-header text-bold">{{ __('PRODUCT') }}</li>
                <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>{{ __('Categories') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('admin/sub-categories*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-code-branch"></i>
                        <p>{{ __('Sub Categories') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('admin/processing-products*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>{{ __('Processing') }}</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('admin/finished-products*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>{{ __('Finished') }}</p>
                    </a>
                </li> -->
                <!-- <li class="nav-item">
                    <a href=""
                        class="nav-link {{ request()->is('admin/transferred-products*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-random"></i>
                        <p>{{ __('Transferred') }}</p>
                    </a>
                </li> -->
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

                <li class="nav-item">
                    <form method="post" action="{{route('superadmin.logout')}}">
                        @csrf
                        <button type="submit" class="btn btn-warning w-100">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
