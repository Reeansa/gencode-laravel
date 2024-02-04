@extends('buyer.template')
@section('title', 'Gencode')
@section('content')
    @include('buyer.partials.session')
    @include('buyer.partials.slider')
    <section class="flat-row main-shop style1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-section margin-bottom-46">
                        <h2 class="title">Produk</h2>
                    </div>
                    <div class="product-content product-fourcolumn clearfix mt-3">
                        <ul class="product style2 isotope-product gutter-15 clearfix">
                            @php $item = 0; @endphp
                            @foreach ($product as $products)
                                @if ($item < 8)
                                    <li class="product-item">
                                        <div class="product-thumb clearfix" style="width: 100%; height: 300px !important;">
                                            <a href="{{ route('produk.show', $products->id) }}">
                                                @if ($products->productImage->isNotEmpty())
                                                    <img src="{{ asset('administrator/storage/' . $products->productImage->first()->image) }}"
                                                        width="100%"
                                                        style="height: 100% !important; object-fit: cover; object-position: center;"
                                                        alt="image">
                                                @endif
                                            </a>
                                            @if ($products->is_new == 1)
                                                <span class="new">New</span>
                                            @elseif ($products->discount == 1)
                                                <span class="new sale">Sale</span>
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
                                            <div class="add-to-cart text-center p-2">
                                                <form action="{{ route('cart.store') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="product" value="{{ $products->id }}">
                                                    <button type="submit">Tambahkan Ke Keranjang</button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="add-to-cart text-center">
                                                <a href="{{ route('produk.show', $products->id) }}">Lihat Detail</a>
                                            </div>
                                        @endauth
                                    </li>
                                    @php $item++; @endphp
                                @endif
                            @endforeach
                        </ul>
                        <div class="elm-btn text-center">
                            <a href="{{ route('produk.index') }}"
                                class="themesflat-button outline ol-accent margin-top-40">MUAT LEBIH BANYAK</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            // Check if there is a WhatsApp URL in the session
            var whatsappUrl = '{{ session('whatsapp_url') }}';
            if (whatsappUrl) {
                // Open a new tab with the WhatsApp URL
                window.open(whatsappUrl, '_blank');
                // Clear the session variable to avoid opening the tab on subsequent visits
                @php session()->forget('whatsapp_url'); @endphp
            }
        </script>
    @endpush
@endsection
