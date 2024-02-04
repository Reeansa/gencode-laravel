@extends('buyer.template')
@section('title', 'Register')
@section('content')
    @include('buyer.partials.session')
    <main class="d-flex align-items-center justify-content-center mt-5">
        <form class="w-auto p-4" action="{{ route('customer.registering') }}" method="post" style="border: 1px solid #86acd4;">
            @csrf
            <h2 class="text-center">Daftar</h2>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                    value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback" style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex" style="gap: 1rem;">
                <div class="form-group">
                    <label for="firstName">Nama Depan</label>
                    <input type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName"
                        id="firstName" value="{{ old('firstName') }}">
                    @error('firstName')
                        <div class="invalid-feedback" style="color: red;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="lastName">Nama Belakang</label>
                    <input type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName"
                        id="lastName" value="{{ old('lastName') }}">
                    @error('lastName')
                        <div class="invalid-feedback" style="color: red;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="phoneNumber">No. Handphone</label>
                <input type="number" class="form-control @error('phoneNumber') is-invalid @enderror" name="phoneNumber"
                    id="phoneNumber" value="{{ old('phoneNumber') }}">
                <small>*Gunakan format 08xxxxxx</small>
                @error('phoneNumber')
                    <div class="invalid-feedback" style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="password">
                @error('password')
                    <div class="invalid-feedback" style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-between align-items-center form-group">
                <div>
                    <button type="submit" class="contact-submit">Daftar</button>
                </div>
                <div>
                    <a href="{{ route('customer.login') }}">Sudah mempunyai akun?</a>
                </div>
            </div>
        </form>
    </main>
@endsection
