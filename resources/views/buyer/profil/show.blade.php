@extends('buyer.template')
@section('title', 'Gencode - Profile Customer')
@section('content')
@include('buyer.partials.session')
    <div class="d-md-flex d-lg-flex align-items-md-center justify-content-md-center container mt-5" style="height: 50vh">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="d-flex align-items-center justify-content-center w-100">
                    <img class="rounded" src="@if ($pelanggan->image == null) {{ asset('buyer/assets/images/profile/thumb-1.jpg') }} @else {{ asset('buyer/assets/images/profile/' . $pelanggan->image) }} @endif" alt="{{ $pelanggan->first_name }}" style="width: 500px; height: 300px; object-fit: cover; object-position: 0 -6rem; border-radius: 2rem;">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <table class="profile-container-text">
                    <tr>
                        <td>Nama Depan</td>
                        <td>:&nbsp;</td>
                        <td class="pl-2">{{ $pelanggan->first_name }}</td>
                    </tr>
                    <tr>
                        <td>Nama Belakang</td>
                        <td>:&nbsp;</td>
                        <td class="pl-2">{{ $pelanggan->last_name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:&nbsp;</td>
                        <td class="pl-2">{{ $pelanggan->email }}</td>
                    </tr>
                    <tr>
                        <td>No. Handphone</td>
                        <td>:&nbsp;</td>
                        <td class="pl-2">{{ $pelanggan->phone }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:&nbsp;</td>
                        <td class="pl-2">{{ $pelanggan->address }}</td>
                    </tr>
                </table>
                <div class="mt-3">
                    <a href="{{ route('pelanggan.edit', $pelanggan->id) }}"><button>Ubah</button></a>
                    <a href="{{ route('pelanggan.history', $pelanggan->id) }}"><button class="btn-primary">Riwayat Pesanan</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
