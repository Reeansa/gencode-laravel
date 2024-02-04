<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item {{ Request::is('administrator/dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <span class="icon-holder">
                        <i class="anticon anticon-dashboard"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ Request::is('administrator/sales/*') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-audit"></i>
                    </span>
                    <span class="title">Penjualan</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('administrator/sales/order') || Request::is('administrator/sales/order/*') ? 'active' : '' }}">
                        <a href="{{ route('order.index') }}">Pesanan</a>
                    </li>
                    <li class="{{ Request::is('administrator/sales/invoice') || Request::is('administrator/sales/invoice/*') ? 'active' : '' }}">
                        <a href="{{ route('invoice.index') }}">Faktur</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::is('administrator/catalog/*') ? 'open' : '' }}">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                        <i class="anticon anticon-shopping-cart"></i>
                    </span>
                    <span class="title">Katalog</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('administrator/catalog/product') || Request::is('administrator/catalog/product/*') ? 'active' : '' }}">
                        <a href="{{ route('product.index') }}">Produk</a>
                    </li>
                </ul>
            </li>
            @if (auth()->user()->roles_id == 1)
                <li class="nav-item dropdown {{ Request::is('administrator/accounts/*') ? 'open' : '' }}">
                    <a class="dropdown-toggle" href="javascript:void(0);">
                        <span class="icon-holder">
                            <i class="anticon anticon-user"></i>
                        </span>
                        <span class="title">Akun</span>
                        <span class="arrow">
                            <i class="arrow-icon"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('administrator/accounts/customer') || Request::is('administrator/accounts/customer/*') ? 'active' : '' }}">
                            <a href="{{ route('customer.index') }}">Customer</a>
                        </li>
                        <li class="{{ Request::is('administrator/accounts/user') || Request::is('administrator/accounts/user/*') ? 'active' : '' }}">
                            <a href="{{ route('user.index') }}">User</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
