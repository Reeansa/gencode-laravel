<div id="site-header-wrap">
    <!-- Header -->
    <header id="header" class="header header-container clearfix">
        <div class="clearfix" id="site-header-inner">
            <div id="logo" class="logo float-left">
                <a href="{{ route('beranda.index') }}" title="logo">
                    <img src="{{ asset('buyer/assets/icon/logo.png') }}" alt="image" width="107" height="24"
                        data-retina="{{ asset('buyer/assets/icon/logo.png') }}" data-width="107" data-height="24">
                </a>
            </div><!-- /.logo -->
            <div class="mobile-button"><span></span></div>
            <ul class="menu-extra">
                @auth('customer')
                    <li>
                        <p>{{ Auth::guard('customer')->user()->first_name }}
                            {{ Auth::guard('customer')->user()->last_name }}</p>
                    </li>
                    <li class="box-login">
                        <a class="icon_login"
                            href="{{ route('pelanggan.show', Auth::guard('customer')->user()->id) }}"></a>
                    </li>
                    <li>
                        <a href="{{ route('customer.logout') }}"><i class='fa fa-sign-out'></i></a>
                    </li>
                    <li class="box-cart nav-top-cart-wrapper">
                        <a class="icon_cart nav-cart-trigger active" href="#"><span>{{ count($cart) }}</span></a>
                        <div class="nav-shop-cart">
                            <div class="widget_shopping_cart_content">
                                <div class="woocommerce-min-cart-wrap">
                                    <ul class="woocommerce-mini-cart cart_list product_list_widget text-center">
                                        @php $item = 0; @endphp
                                        @forelse($cart as $carts)
                                            @if ($item < 2)
                                                <li
                                                    class="woocommerce-mini-cart-item mini_cart_item d-flex flex-column pb-3 text-right">
                                                    <img src="{{ asset('administrator/storage/' . $carts->product->productImage->first()->image) }}"
                                                        alt="{{ $carts->name }}"
                                                        style="max-height: 100px; object-fit: cover; object-position: center;">
                                                    <p>{{ $carts->product->name }}</p>
                                                    <span><b>Rp. {{ number_format($carts->product->price) }}</b></span>
                                                </li>
                                                @php $item++; @endphp
                                            @endif
                                        @empty
                                            <li class="woocommerce-mini-cart-item mini_cart_item">
                                                <span>Tidak Ada Produk di Keranjang Belanja</span>
                                            </li>
                                        @endforelse
                                        @if ($item > 0)
                                            <li
                                                class="woocommerce-mini-cart-item mini_cart_item d-flex flex-column pb-3 mt-3">
                                                <a href="{{ route('cart.index') }}"
                                                    class="button-cart">Lihat Keranjang</a>
                                            </li>
                                        @endif
                                    </ul>
                                </div><!-- /.widget_shopping_cart_content -->
                            </div>
                        </div><!-- /.nav-shop-cart -->
                    </li>
                @else
                    <li class="box-login">
                        <a class="icon_login" href="{{ route('customer.login') }}" data-toggle="tooltip"
                            data-placement="bottom" title="Klik disini jika ingin melakukan login"></a>
                            <span> < Login/Daftar</span>
                    </li>
                @endauth
            </ul><!-- /.menu-extra -->
            <div class="nav-wrap">
                <nav id="mainnav" class="mainnav">
                    <ul class="menu">
                        <li class="{{ request()->is('beranda') ? 'active' : '' }}">
                            <a href="{{ route('beranda.index') }}">BERANDA</a>
                        </li>
                        <li class="{{ request()->is('produk') ? 'active' : '' }}">
                            <a href="{{ route('produk.index') }}">SOURCE CODE</a>
                        </li>
                        <li class="{{ request()->is('tentang-kami') ? 'active' : '' }}">
                            <a href="{{ route('tentang-kami.index') }}">TENTANG KAMI</a>
                        </li>
                        @auth('customer')
                            @if ($item > 0)
                                <li class="d-lg-none d-md-none">
                                    <a href="{{ route('cart.index', $carts->customer_id) }}">CART</a>
                                </li>
                            @endif
                            <li class="d-lg-none d-md-none" class="{{ request()->is('auth/login') ? 'active' : '' }}">
                                <a
                                    href="{{ route('customer.show', Auth::guard('customer')->user()->id) }}">{{ Auth::guard('customer')->user()->first_name . ' ' . Auth::guard('customer')->user()->last_name }}</a>
                            </li>
                            <li class="d-lg-none d-md-none">
                                <a href="{{ route('logout') }}">LOGOUT</a>
                            </li>
                        @else
                            <li class="d-lg-none d-md-none" class="{{ request()->is('buyer/login') ? 'active' : '' }}">
                                <a href="{{ route('customer.login') }}">LOGIN</a>
                            </li>
                        @endauth
                    </ul>
                </nav><!-- /.mainnav -->
            </div><!-- /.nav-wrap -->
        </div><!-- /.container-fluid -->
    </header><!-- /header -->
</div>
