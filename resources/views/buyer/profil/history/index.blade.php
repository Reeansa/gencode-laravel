@extends('buyer.template')
@section('title', 'History')
@section('content')
@include('buyer.partials.session')
    <div class="container mt-5 shadow" style="height: 50vh; background-color: #fff; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nomor Faktur</th>
                    <th>Nama Produk</th>
                    <th>Status</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($history->count() > 0)
                    @foreach ($history as $histories)
                        <tr>
                            <td>{{ $histories->order_number }}</td>
                            <td>{{ $histories->product->name }}</td>
                            <td><span
                                    class="rounded p-2 @if ($histories->status == 'sudah bayar') green @elseif($histories->status == 'cancel') red @else yellow @endif">{{ $histories->status }}</span>
                            </td>
                            <td>
                                @if ($histories->status == 'belum bayar')
                                    <p>Menunggu Negosiasi...</p>
                                    @elseif($histories->status == 'cancel')
                                    <p>Tidak terjadi transaksi</p>
                                    @else
                                    <a href="{{ route('print-faktur', $histories->id) }}" id="print">Cetak PDF</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data riwayat pesanan yang dapat ditampilkan</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
