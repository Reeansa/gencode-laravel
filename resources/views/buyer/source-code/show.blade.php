@extends('buyer.template')
@section('title', 'Detail Product')
@section('page', 'Detail Product')
@section('content')
    <section class="flat-row main-shop shop-detail style-1">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="wrap-flexslider clearfix">
                        <div class="inner padding-top-5">
                            <div class="flexslider style-2 has-relative">
                                <ul class="slides">
                                    @foreach ($produk->productImage as $images)
                                        <li data-thumb="{{ asset('administrator/storage/'.$images->image) }}">
                                                <img src="{{ asset('administrator/storage/'. $images->image) }}"
                                                    alt="Image">
                                                <div class="flat-icon style-1">
                                                    <a href="{{ asset('administrator/storage/'. $images->image) }}"
                                                        class="zoom-popup"><span class="fa fa-search-plus"></span></a>
                                                </div>
                                            </li>
                                    @endforeach
                                </ul>
                            </div><!-- /.flexslider -->
                        </div>
                    </div>
                </div><!-- /.col-md-6 -->

                <div class="col-md-6">
                    <div class="divider h0"></div>
                    <div class="product-detail clearfix">
                        <div class="inner">
                            <div class="content-detail">
                                <h2 class="product-title mb-5">{{ $produk->name }}</h2>
                                <p>{{ $produk->description }} </p>
                                <div class="price">
                                    @if ($produk->discount_price > 0)
                                        <del>
                                            <p class="regular">Rp.
                                                {{ number_format($produk->price, 2) }}</p>
                                        </del>
                                        <ins>
                                            <p class="amount">Rp.
                                                {{ number_format($produk->price - $produk->discount_price, 2) }}</p>
                                        </ins>
                                    @else
                                        <ins>
                                            <p class="amount">Rp.
                                                {{ number_format($produk->price, 2) }}</p>
                                        </ins>
                                    @endif
                                </div>
                                @auth('customer')
                                    <div class="product-quantity margin-top-49">
                                        <div class="add-to-cart no-margin">
                                            <a onclick="document.getElementById('detailProduct').submit();" style="cursor: pointer;">Tambah Kedalam Keranjang</a>
                                            <form action="{{ route('cart.store') }}" method="post"
                                                id="detailProduct">
                                                @csrf
                                                <input type="hidden" name="product" value="{{ $produk->id }}">
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <div class="product-quantity margin-top-49">
                                        <div class="add-to-cart no-margin">
                                            <a href="{{ route('customer.login') }}">Beli Sekarang!</a>
                                        </div>
                                        <p>*login terlebih dahulu untuk membeli</p>
                                    </div>
                                @endauth
                                {{-- <div class="product-categories margin-top-49">
                                    <span>Categories: </span><a href="#">Men,</a> <a href="#">Shoes</a>
                                </div> --}}
                            </div>
                        </div>
                    </div><!-- /.product-detail -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.flat-row -->
@endsection
