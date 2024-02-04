@extends('administrator.template')
@section('title', 'Order Edit')
@section('content')
    <a href="" class="btn btn-danger btn-tone m-r-5"><span>Cancel Order</span></a>
    <a href="" class="btn btn-primary btn-tone m-r-5">Inovice</a>
    <section class="row mt-3">
        <div class="col-8">
            <div class="card rounded-md">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <div class="d-md-flex align-items-center">
                                <div class="text-center text-sm-left ">
                                    <div class="avatar avatar-image" style="width: 50px; height:50px">
                                        <img src="{{ asset('assets/images/product/' . $order->product->image) }}"
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
                                                <span>Price:</span>
                                            </p>
                                            <p class="col"> Rp {{ number_format($order->product->price) }}</p>
                                        </li>
                                        <li class="row">
                                            <p class="col-sm-4 col-4">
                                                <span>Sub Total:</span>
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
                                                <span>Price:</span>
                                            </p>
                                            <p class="col">Rp. {{ number_format($order->product->price) }}</p>
                                        </li>
                                        <li class="row">
                                            <p class="col-sm-9 col-9">
                                                <span>Sub Total:</span>
                                            </p>
                                            <p class="col">Rp. {{ number_format($order->product->price) }}</p>
                                        </li>
                                        <li class="row">
                                            <p class="col-sm-9 col-9">
                                                <b>Total Paid: Rp.</b>
                                            </p>
                                            <form action="" method="post" class="col">
                                                @csrf
                                                <div class="input-group input-group-sm mb-3">
                                                    <input type="number" name="paid" class="form-control w-100"
                                                        aria-label="Sizing example input"
                                                        aria-describedby="inputGroup-sizing-sm">
                                                    <small for="paid">*input paid</small>
                                                </div>
                                            </form>
                                        </li>
                                        <li class="row">
                                            <p class="col-sm-9 col-9">
                                                <span>Total Due:</span>
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
            @if ($order->negotiation)
                <div class="card">
                    <div class="card-body">
                        <div class="mt-3">
                            <h6>Current Negotiation</h6>
                            <p>Original Price: Rp {{ number_format($order->negotiation->original_price) }}</p>
                            <p>Negotiated Price: Rp {{ number_format($order->negotiation->negotiated_price) }}</p>
                            <p>Status: {{ $order->negotiation->agreed ? 'Agreed' : 'Pending' }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h5>Comments</h5>
                    <div id="editor">
                        <p>comment here</p>
                    </div>
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
                                <span>Order Information</span>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseOrdersInformationAccordion" class="collapse show"
                        data-parent="#ordersInformationAccordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">Order Date</div>
                                <div class="col-md-6">{{ $order->created_at }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Order Status</div>
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
                                <span>Payments and Shipping</span>
                            </a>
                        </h5>
                    </div>
                    <div id="collapsePayShipAccordion" class="collapse show" data-parent="#payShipAccordion">
                        <div class="card-body">
                            <div>
                                <h6>Payment Method</h6>
                                <p>{{ $order->payment_by }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion borderless shadow-sm mb-3" id="invoicesAccordion">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <a data-toggle="collapse" href="#collapseInvoicesAccordion">
                                <span>Invoices</span>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseInvoicesAccordion" class="collapse show" data-parent="#invoicesAccordion">
                        <div class="card-body">
                            <div>
                                <h6>nama invoice</h6>
                                <p>tanggal dan waktu</p>
                            </div>
                            <div class="d-flex" style="gap: 15px;">
                                <a href="">View</a>
                                <a href="">Download PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion borderless shadow-sm mb-3" id="shipmentsAccordion">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <a data-toggle="collapse" href="#collapseShipmentsAccordion">
                                <span>Shipments</span>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseShipmentsAccordion" class="collapse show" data-parent="#shipmentsAccordion">
                        <div class="card-body">
                            ...
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion borderless shadow-sm mb-3" id="refundsAccordion">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <a data-toggle="collapse" href="#collapseRefundsAccordion">
                                <span>Refunds</span>
                            </a>
                        </h5>
                    </div>
                    <div id="collapseRefundsAccordion" class="collapse show" data-parent="#refundsAccordion">
                        <div class="card-body">
                            <div>
                                <h6>Refunds name</h6>
                                <p>date</p>
                            </div>
                            <div>
                                <h6>Name</h6>
                                <p>Name</p>
                            </div>
                            <div>
                                <h6>Status</h6>
                                <p>Refunded <b>price</b></p>
                            </div>
                            <a href="">View</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script src="{{ asset('administrator/assets/css/quill/quill.min.js') }}"></script>
        <script>
            new Quill('#editor', {
                theme: 'snow'
            });
        </script>
    @endpush
@endsection
