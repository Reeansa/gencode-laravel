@extends('buyer.template')
@section('title', 'Edit Profil')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex flex-column justify-content-center" style="gap: 2rem;">
                    <img class="rounded"
                        src="@if ($pelanggan->image) {{ asset('buyer/assets/images/profile/' . $pelanggan->image) }} @else {{ asset('buyer/assets/images/profile/thumb-1.jpg') }} @endif"
                        alt="{{ $pelanggan->first_name }}"
                        style="width: 500px; height: 300px; object-fit: cover; object-position: 0 -6rem; border-radius: 2rem;">
                    <form action="{{ route('pelanggan.image.update', $pelanggan->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="file" class="@error('image') is-invalid @enderror" name="image" id="image">
                        @error('image')
                            <div class="invalid-feedback" style="color: red;">
                                {{ $message }}
                            </div>
                        @enderror
                        <button type="submit" style="padding: 5px 10px 5px 10px;">Ubah</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="firstName">Nama Depan</label>
                        <input type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName"
                            name="firstName" value="{{ old('firstName', $pelanggan->first_name) }}">
                        @error('firstName')
                            <div class="invalid-feedback" style="color: red;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lastName">Nama Belakang</label>
                        <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName"
                            name="lastName" value="{{ old('lastName', $pelanggan->last_name) }}">
                        @error('lastName')
                            <div class="invalid-feedback" style="color: red;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $pelanggan->email) }}">
                        @error('email')
                            <div class="invalid-feedback" style="color: red;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">No. Handphone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                            name="phone" value="{{ old('phone', $pelanggan->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback" style="color: red;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address">{{ old('address', $pelanggan->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback" style="color: red;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit">Ubah</button>
                    </div>
                </form>
                <form action="{{ route('pelanggan.password.update', $pelanggan->id) }}" method="post" class="mt-5">
                    @csrf
                    @method('put')
                    <h2 class="mb-4">ubah Kata Sandi</h2>
                    <div class="form-group">
                        <label for="currentPassword">Kata Sandi Lama</label>
                        <input type="password" class="form-control @error('currentPassword') is-invalid @enderror"
                            id="currentPassword" name="currentPassword">
                        @error('currentPassword')
                            <div class="invalid-feedback" style="color: red;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="newPassword">Kata Sandi Baru</label>
                        <input type="password" class="form-control @error('newPassword') is-invalid @enderror"
                            id="newPassword" name="newPassword">
                        @error('newPassword')
                            <div class="invalid-feedback" style="color: red;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Kata Sandi Konfirmasi</label>
                        <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror"
                            id="confirmPassword" name="confirmPassword">
                        @error('confirmPassword')
                            <div class="invalid-feedback" style="color: red;">
                                {{ $message }}
                            </div>
                        @enderror
                        <span>*harus sama dengan kata sandi baru</span>
                    </div>
                    <div>
                        <button type="submit">Ubah</button>
                    </div>
                </form>
                <h2 class="mt-5 mb-3">Pengaturan Akun</h2>
                <div class="d-flex" style="gap: 1rem;">
                    <form action="{{ route('pelanggan.deactive-account', $pelanggan->id) }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit">Nonaktif akun</button>
                    </form>
                    <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit">Hapus akun</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
