@extends('buyer.template')
@section('title', 'Cart')
@section('content')
@include('buyer.partials.session')
    <div class="container mt-5">
        <div class="row">
            @foreach ($cart as $carts)
                <div class="col-md-12 mb-5">
                    <div class="row pb-4" style="border-bottom: 1px solid #283149;">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-end">
                                <img src="{{ asset('administrator/storage/' . $carts->product->productImage->first()->image) }}" width="50%"
                                    alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column justify-content-center h-100" style="gap: 1rem;">
                                <form action="{{ route('cart.buy', $carts->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $carts->product->name }}">
                                    <h4 class="mb-4">{{ $carts->product->name }}</h4>
                                    <h4 class="mb-4">{{ $carts->product->description }}</h4>
                                    <div>
                                        <input type="hidden" name="price" value="{{ $carts->product->price }}">
                                            <h5>Rp. {{ number_format($carts->product->price, 2) }}</h5>
                                    </div>
                                    <div class="w-100 text-right">
                                        <button type="submit">Negosiasi</button>
                                    </div>
                                </form>
                                <form class="w-100 text-right" action="{{ route('cart.destroy', $carts->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
