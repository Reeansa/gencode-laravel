@extends('administrator.template')
@section('title', 'Order Edit')
@section('content')
    {{ Breadcrumbs::render('order.edit', $order) }}
    <div class="d-flex" style="gap: 0.5rem;">
        <form action="{{ route('order.cancel', $order->id) }}" method="post">
            @csrf
            @method('put')
        <button type="submit" class="btn btn-danger btn-tone m-r-5"><span>Cancel Order</span></button>
        </form>
    <button type="button" class="btn btn-primary btn-tone m-r-5"
        onclick="document.getElementById('ordersInvoice').submit();">Invoice</button>
    </div>
    <section class="row mt-3">
        <div class="col-8">
            <div class="card rounded-md">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <div class="d-md-flex align-items-center">
                                <div class="text-center text-sm-left ">
                                    <div class="avatar avatar-image" style="width: 50px; height:50px">
                                        <img src="{{ asset('administrator/storage/' . $order->product->productImage->first()->image) }}"
                                            alt="" style="object-fit: cover; object-position: center;">
                                    </div>
                                </div>
                                <div class="text-center text-sm-left p-l-30">
                                    <h5 class="m-b-5">{{ $order->product->name }}</h5>
                                    <p>Rp. {{ number_format($order->product->price) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="d-md-block d-none border-left col-1"></div>
                                <div class="col">
                                    <ul class="list-unstyled m-t-10 text-right">
                                        <li class="row">
                                            <p class="col-sm-4 col-4">
                                                <span>Harga:</span>
                                            </p>
                                            <p class="col"> Rp {{ number_format($order->product->price) }}</p>
                                        </li>
                                        <li class="row">
                                            <p class="col-sm-4 col-4">
                                                <span>Total:</span>
                                            </p>
                                            <p class="col"> Rp {{ number_format($order->product->price) }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 border-top text-right">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="list-unstyled m-t-10 text-right">
                                        <li class="row">
                                            <p class="col-sm-9 col-9">
                                                <span>Total Bayar:</span>
                                            </p>
                                            <p class="col">Rp. {{ number_format($order->product->price) }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('order.negotiate-price', $order->id) }}" method="post" id="ordersInvoice">
                        @csrf
                        <div class="input-group input-group-sm mb-3">
                            <label for="">Masukkan Harga:</label>
                            <input type="hidden" name="original_price" value="{{ $order->product->price }}">
                            <input type="number" name="paid" class="form-control w-100"
                                aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            <small for="paid">*memasukkan nilai jika pelanggan meminta negosiasi.</small>
                        </div>
                        <div>
                            <h5>Link Source Code</h5>
                            <input type="text" class="form-control" name="sourceCode" id="sourceCode"
                                placeholder="Link Source Code">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-4">
            <div class="accordion borderless shadow-sm mb-3" id="customerAccordion">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <a data-toggle="collapse" href="#collapseCustomerAccordion">
                                <span>Customer</span>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseCustomerAccordion" class="collapse show" data-parent="#ordersInformationAccordion">
                        <div class="card-body">
                            <div>
                                <h6>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</h6>
                                <p>{{ $order->customer->email }}</p>
                            </div>
                        </div>
                        <div class="card-body border border-top pt-4">
                            <div>
                                <p>{{ $order->customer->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion borderless shadow-sm mb-3" id="ordersInformationAccordion">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <a data-toggle="collapse" href="#collapseOrdersInformationAccordion">
                                <span>Informasi Pemesanan</span>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseOrdersInformationAccordion" class="collapse show"
                        data-parent="#ordersInformationAccordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">Tanggal Pemesanan</div>
                                <div class="col-md-6">{{ $order->created_at }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Status Pesanan</div>
                                <div class="col-md-6">{{ $order->status }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion borderless shadow-sm mb-3" id="payShipAccordion">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <a data-toggle="collapse" href="#collapsePayShipAccordion">
                                <span>Pembayaran</span>
                            </a>
                        </h5>
                    </div>
                    <div id="collapsePayShipAccordion" class="collapse show" data-parent="#payShipAccordion">
                        <div class="card-body">
                            <div>
                                <h6>Metode Pembayaran</h6>
                                <p>{{ $order->payment_by }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
