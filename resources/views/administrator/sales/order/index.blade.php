@extends('administrator.template')
@section('title', 'Orders')
@section('content')
    {{ Breadcrumbs::render('order') }}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover e-commerce-table">
                    <thead>
                        <tr>
                            <th>Nomor Pesanan / Tanggal</th>
                            <th>Pembayaran</th>
                            <th>Informasi</th>
                            <th></th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <h5>{{ $order->order_number }}</h5>
                                    <p>{{ $order->created_at }}</p>
                                </td>
                                <td>
                                    <h5>{{ $order->formatted_total_amount }}</h5>
                                    <p>{{ $order->payment_by }}</p>
                                </td>
                                <td>
                                    <h5>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</h5>
                                    <p>{{ $order->customer->email }}</p>
                                    <p>{{ $order->customer->address }}</p>
                                </td>
                                <td>
                                    <img src="{{ asset('administrator/storage/' . $order->product->productImage->first()->image) }}"
                                        width="50" alt="{{ $order->product->name }}">
                                </td>
                                <td>
                                    @if ($order->status == 'sudah bayar')
                                        <span class="badge badge-pill badge-green font-size-12">{{ $order->status }}</span>
                                    @elseif($order->status == 'cancel')
                                        <span class="badge badge-pill badge-red font-size-12">{{ $order->status }}</span>
                                    @else
                                        <span class="badge badge-pill badge-gold font-size-12">{{ $order->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($order->status == 'belum bayar')
                                        <a href="{{ route('order.edit', $order->id) }}"><i
                                                class="anticon anticon-eye"></i>&nbsp;&nbsp;Lihat</a>
                                    @elseif($order->status == 'cancel')
                                    @else
                                    <a href="{{ route('invoice.show', $order->id) }}"><i
                                                class="anticon anticon-file-pdf"></i>&nbsp;&nbsp;Faktur</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('administrator/assets/js/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('administrator/assets/js/datatables/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('administrator/assets/js/pages/e-commerce-order-list.js') }}"></script>
    @endpush
@endsection
