@extends('administrator.template')
@section('title', 'Dashboard')
@section('content')
    {{ Breadcrumbs::render('dashboard') }}
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="m-b-0 text-muted">Pesanan</p>
                                    <h2 class="m-b-0">{{ count($orders) }}</h2>
                                </div>
                                <span
                                    class="badge badge-pill @if ($precentageOrders > 0) badge-cyan
                                    @elseif($precentageOrders < 0)
                                    badge-red
                                    @else
                                    badge-blue @endif font-size-12">
                                    <i class="anticon anticon-arrow-up"></i>
                                    <span
                                        class="font-weight-semibold m-l-5">{{ number_format($precentageOrders, 2) . '%' }}</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Customer</h5>
                            </div>
                            <div class="m-t-30">
                                <ul class="list-group list-group-flush">
                                    @foreach ($customers as $customer)
                                        <li class="list-group-item p-h-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-image m-r-15">
                                                        <img src="@if ($customer->image == null) {{ asset('buyer/assets/images/profile/thumb-1.jpg') }} @else {{ asset('buyer/assets/images/profile/' . $customer->image) }} @endif"
                                                            alt="{{ $customer->first_name . ' ' . $customer->last_name }}"
                                                            style="object-fit: cover;">
                                                    </div>
                                                    <div>
                                                        <h6 class="m-b-0">
                                                            <a href="javascript:void(0);"
                                                                class="text-dark">{{ $customer->first_name . ' ' . $customer->last_name }}</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5>Produk Teratas</h5>
                            </div>
                            <div class="m-t-30">
                                <ul class="list-group list-group-flush">
                                    @foreach ($products as $product)
                                        <li class="list-group-item p-h-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-image m-r-15">
                                                        <img src="{{ asset('administrator/storage/' . $product->productImage->first()->image) }}"
                                                            alt="{{ $product->name }}">
                                                    </div>
                                                    <div>
                                                        <h6 class="m-b-0">
                                                            <a href="javascript:void(0);"
                                                                class="text-dark">{{ $product->name }}</a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Pesanan Terbaru</h5>
                    </div>
                    <div class="m-t-30">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Customer</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-image"
                                                            style="height: 30px; min-width: 30px; max-width:30px">
                                                            <img src="@if($order->customer->image) {{ asset('buyer/assets/images/profile/' . $order->customer->image) }} @else {{ asset('buyer/assets/images/profile/thumb-1.jpg') }} @endif"
                                                                alt="{{ $order->customer->first_name . ' ' . $order->customer->last_name }}">
                                                        </div>
                                                        <h6 class="m-l-10 m-b-0">
                                                            {{ $order->customer->first_name . ' ' . $order->customer->last_name }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $date = $order->created_at;
                                                    $dateConvert = date('d M Y', strtotime($date));
                                                @endphp
                                                {{ $dateConvert }}</td>
                                            <td>Rp. {{ number_format($order->product->price) }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="badge badge-pill @if($order->status == 'sudah bayar') badge-green @elseif($order->status == 'cancel') badge-red @else badge-gold @endif m-r-10">{{ $order->status }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
