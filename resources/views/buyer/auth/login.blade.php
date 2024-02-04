@extends('buyer.template')
@section('title', 'login')
@section('content')
    @include('buyer.partials.session')
    <main class="d-flex align-items-center justify-content-center mt-3" style="height: 50vh;">
        <form class="w-auto p-4" action="{{ route('customer.authenticate') }}" method="POST"
            style="border: 1px solid #86acd4;">
            @csrf
            <h2 class="text-center">Login</h2>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback" style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan Kata Sandi" required>
                @error('password')
                    <div class="invalid-feedback" style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-between justify- align-items-center form-group">
                <button type="submit" class="contact-submit">Login</button>
                <a href="{{ route('customer.register') }}">Daftar</a>
            </div>
        </form>
    </main>
@endsection
