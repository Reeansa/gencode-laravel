@extends('administrator.template')
@section('title', 'Invoices')
@section('content')
    {{ Breadcrumbs::render('invoice') }}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover e-commerce-table">
                    <thead>
                        <tr>
                            <th>Nomor Pesanan</th>
                            <th>Total Keseluruhan</th>
                            <th>Status</th>
                            <th>Tanggal Faktur</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice as $invoices)
                            <tr>
                                <td>
                                    <h5>{{ $invoices->order->order_number }}</h5>
                                </td>
                                <td>
                                    <p>{{ $invoices->price }}</p>
                                </td>
                                <td>
                                    @if ($invoices->status == 'paid')
                                        <span class="badge badge-pill badge-green font-size-12">{{ $invoices->status }}</span>
                                    @elseif($invoices->status == 'cancel')
                                        <span class="badge badge-pill badge-red font-size-12">{{ $invoices->status }}</span>
                                    @else
                                        <span class="badge badge-pill badge-gold font-size-12">{{ $invoices->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <p>{{ $invoices->created_at }}</p>
                                </td>
                                <td>
                                    @if ($invoices->status == 'belum bayar')
                                        <a href="{{ route('invoices.show', $invoices->id) }}"><i
                                                class="anticon anticon-eye"></i>&nbsp;&nbsp;Lihat</a>
                                    @else
                                        <a href="{{ route('print-invoice', $invoices->id) }}"><i
                                                class="anticon anticon-file-pdf"></i>&nbsp;&nbsp;Print</a>
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
