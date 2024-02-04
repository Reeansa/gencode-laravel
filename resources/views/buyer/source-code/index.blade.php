@extends('buyer.template')
@section('title', 'Gencode - Source Code')
@section('page', 'Source Code')
@section('content')
    @include('buyer.partials.pagetitle')
    <section class="flat-row main-shop">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-top-menu margin-bottom-58">
                        <ul class="flat-filter style-2">
                            <li class="active"><a data-filter="*">Semua Source Code</a></li>
                            <li><a href="#" data-filter=".new">Baru</a></li>
                            <li><a href="#" data-filter=".old">Lama</a></li>
                        </ul>
                    </div>
                    <div class="filter-shop clearfix">
                        <ul class="flat-filter-search">
                            <li class="search-product"><a>Cari</a></li>
                        </ul>
                    </div>
                    <div class="shop-search clearfix">
                        <form action="{{ route('produk.index') }}" class="search-form">
                            <input type="text" class="search-field" placeholder="Sedang Mencari …"
                                value="{{ request('search') }}" name="search">

                        </form>
                    </div>
                    <div class="product-content product-fivecolumn clearfix">
                        <ul class="product style3 isotope-product clearfix">
                            @foreach ($product as $products)
                                <li
                                    class="product-item @if ($products->is_new == 1) new @elseif($products->is_new == 0) old @endif">
                                    <div class="product-thumb clearfix">
                                        <a href="{{ route('produk.show', $products->id) }}">
                                            @if ($products->productImage->isNotEmpty())
                                            <img src="{{ asset('administrator/storage/' . $products->productImage->first()->image) }}"
                                                alt="{{ $products->name }}">
                                                @endif
                                        </a>
                                        @if ($products->is_new == 1)
                                            <span class="new">Baru</span>
                                        @endif
                                    </div>
                                    <div class="product-info clearfix">
                                        <span class="product-title">{{ $products->name }}</span>
                                        <div class="price">
                                            @if ($products->discount_price > 0)
                                                <del>
                                                    <p class="regular">Rp.
                                                        {{ number_format($products->price, 2) }}</p>
                                                </del>
                                                <ins>
                                                    <p class="amount">Rp.
                                                        {{ number_format($products->price - $products->discount_price, 2) }}
                                                    </p>
                                                </ins>
                                            @else
                                                <ins>
                                                    <p class="amount">Rp.
                                                        {{ number_format($products->price, 2) }}</p>
                                                </ins>
                                            @endif
                                        </div>
                                    </div>
                                    @auth('customer')
                                        <div class="add-to-cart no-margin p-2">
                                            <form action="{{ route('cart.store') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product" value="{{ $products->id }}">
                                                <button type="submit">Tambah Keranjang</button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="add-to-cart text-center">
                                            <a href="{{ route('produk.show', $products->id) }}">See Detail</a>
                                        </div>
                                    @endauth
                                </li>
                            @endforeach
                        </ul><!-- /.product -->
                        <div class="d-flex justify-content-center w-100 mt-5">
                            {{ $product->links('pagination::bootstrap-4') }}
                        </div>
                    </div><!-- /.product-content -->
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.flat-row -->
@endsection
