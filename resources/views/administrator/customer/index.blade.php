@extends('administrator.template')
@section('title', 'Costumers')
@section('content')
{{ Breadcrumbs::render('customer') }}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="data-table" class="table table-hover e-commerce-table">
                    <thead>
                        <tr>
                            <th>Nama Customer / Email / Nomor Kontak</th>
                            <th>Status</th>
                            <th>Jumlah Pendapatan / Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer as $customers)
                            <tr>
                                <td>
                                    <h5>{{ $customers->first_name . ' ' . $customers->last_name }}</h5>
                                    <p>{{ $customers->email }}</p>
                                    <p>{{ $customers->phone }}</p>
                                </td>
                                <td>
                                    @if ($customers->status == 1)
                                        <form action="{{ route('customer.update-status', $customers->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="badge badge-pill badge-green"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Klik ini untuk mengubah status">Aktif</button>
                                        </form>
                                    @else
                                        <form action="{{ route('customer.update-status', $customers->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="badge badge-pill badge-red"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Klik ini untuk mengubah status">Tidak Aktif</button>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <h5>Rp. {{ number_format($customers->amount) }}</h5>
                                            <p>{{ count($customers->orders) }} Pesanan</p>
                                        </div>
                                        <div class="col-md-6 col-lg-6 my-auto">
                                            <a class="p-5" href="{{ route('customer.show', $customers->id) }}"><i
                                                    class="anticon anticon-edit font-size-20"></i></a>
                                        </div>
                                    </div>
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
        <script src="{{ asset('administrator/assets/js/datatables/datatables.js') }}"></script>
    @endpush
@endsection
