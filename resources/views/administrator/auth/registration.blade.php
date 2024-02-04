@section('title', 'Register')
<!DOCTYPE html>
<html lang="en">
    @include('administrator.partials.head')
    <body>
        @include('administrator.partials.session')
        <div class="app">
            <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex"
                style="background-image: url('assets/images/others/login-3.png')">
                <div class="d-flex flex-column justify-content-between w-100">
                    <div class="container d-flex h-100">
                        <div class="row align-items-center w-100">
                            <div class="col-md-7 col-lg-5 m-h-auto">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between m-b-30">
                                            <img class="img-fluid" alt="" src="{{ asset('assets/img/logo/logo.png') }}" width="100">
                                            <h2 class="m-b-0">Daftar</h2>
                                        </div>
                                        <form action="{{ route('seller.registering') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="firstName">Nama Depan:</label>
                                                <input type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName" value="{{ old('firstName') }}"
                                                    placeholder="Nama Depan" name="firstName">
                                                    @error('firstName')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="lastName">Nama Belakang:</label>
                                                <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" value="{{ old('lastName') }}"
                                                    placeholder="Nama Belakang" name="lastName">
                                                    @error('lastName')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="email">Email:</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}"
                                                    placeholder="Email" name="email">
                                                    @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="password">Kata Sandi:</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Kata Sandi">
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="confirmPassword">Kata Sandi Konfirmasi:</label>
                                                <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror" id="confirmPassword"
                                                    placeholder="Kata Sandi Yang Sama" name="confirmPassword">
                                                    @error('confirmPassword')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <span>Sudah mempunyai akun?&nbsp;</span><a href="{{ route('login') }}">Login</a>
                                                <div class="d-flex align-items-center justify-content-between p-t-15">
                                                    <button class="btn btn-primary">Daftar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-md-flex p-h-40 justify-content-between">
                        <span class="">© 2024 ThemeNate updated by Gencode</span>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a class="text-dark text-link" href="">Hukum</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-dark text-link" href="">Privasi</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{-- Core Vendor JS --}}
        <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#notif').hide();
                $('#notif').fadeIn('slow');
                setTimeout(function() {
                    $('#notif').fadeOut('slow');
                }, 5000);
            });
        </script>

        {{-- Core JS --}}
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
    </body>

</html>
