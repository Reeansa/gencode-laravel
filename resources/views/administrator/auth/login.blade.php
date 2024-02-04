@section('title', 'Login')
<!DOCTYPE html>
<html lang="en">
    @include('administrator.partials.head')
    @include('administrator.partials.session')
    <body>
        <div class="app">
            <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex">
                <div class="d-flex flex-column justify-content-between w-100">
                    <div class="container d-flex h-100 justify-content-center">
                        <div class="row align-items-center w-100">
                            <div class="col-md-7 col-lg-5 m-h-auto">
                                {{-- @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif --}}
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between m-b-30">
                                            <img class="img-fluid" alt=""
                                                src="{{ asset('administrator/assets/img/logo/logo.png') }}" width="100">
                                            <h2 class="m-b-0">Login</h2>
                                        </div>
                                        <form action="{{ route('authenticate') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="email">email:</label>
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                                    placeholder="Email" value="{{ old('email') }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-semibold" for="password">Kata Sandi:</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                                    placeholder="Kata Sandi" required>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="font-size-13 text-muted">
                                                        Tidak mempunyai akun?
                                                        <a class="small" href="{{ route('seller.register') }}"> Daftar</a>
                                                    </span>
                                                    <button class="btn btn-primary">Login</button>
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
        <script src="{{ asset('administrator/assets/js/vendors.min.js') }}"></script>
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
        <script src="{{ asset('administrator/assets/js/app.min.js') }}"></script>
    </body>

</html>
