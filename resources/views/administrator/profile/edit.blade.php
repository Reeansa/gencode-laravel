@extends('administrator.template')
@section('title', 'Edit Profile')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Informasi Dasar</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update-image', $user->id) }}" method="POST" id="image-upload"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="media align-items-center">
                        <div class="avatar avatar-image  m-h-10 m-r-15" style="height: 80px; width: 80px">
                            <img src="@if ($user->image) {{ asset('administrator/storage/' . $user->image) }} @else {{ asset('administrator/assets/img/profiles/thumb-1.jpg') }} @endif"
                                id="previewImage" alt="{{ $user->first_name }}"
                                style="object-fit: cover; object-position: center;">
                        </div>
                        <div class="m-l-20 m-r-20">
                            <h5 class="m-b-5 font-size-18">Ubah Foto Profil</h5>
                            <p class="opacity-07 font-size-13 m-b-0">
                                Rekomendasi format dan ukuran foto: <br>
                                jpg, jpeg, png dan max: 2MB
                            </p>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                id="inputImage" name="image">
                            <label class="custom-file-label" for="inputImage">Pilih Foto</label>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Ubah</button>
                </form>
                <hr class="m-v-25">
                <form action="{{ route('profile.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-semibold" for="firstName">Nama Depan:</label>
                            <input type="text" class="form-control @error('firstName') is-invalid @enderror"
                                id="firstName" name="firstName" placeholder="Nama Depan" value="{{ $user->first_name }}"
                                required>
                            @error('firstName')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-semibold" for="lastName">Nama Belakang:</label>
                            <input type="text" class="form-control @error('lastName') is-invalid @enderror"
                                id="lastName" name="lastName" placeholder="Nama Belakang" value="{{ $user->last_name }}"
                                required>
                            @error('lastName')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="font-weight-semibold" for="email">Email:</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Email" value="{{ $user->email }}" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-semibold" for="phone">No. Telepon:</label>
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" placeholder="No. Telepon" value="{{ $user->phone }}" required>
                            <small>*gunakan format 08xxxxxxxxxx</small>
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-semibold" for="role">Status:</label>
                            <input type="hidden" class="form-control" name="role" value="{{ $user->roles->name }}">
                            <input type="text" class="form-control" placeholder="role" value="{{ $user->roles->name }}"
                                disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="font-weight-semibold" for="fullAddress">Alamat Lengkap:</label>
                            <input type="text" class="form-control @error('fullAddress') is-invalid @enderror"
                                id="fullAddress" name="fullAddress" placeholder="Alamat Lengkap" value="{{ $user->address }}"
                                required>
                            @error('fullAddress')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <button class="btn btn-primary m-t-30">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ubah Kata Sandi</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update-password', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="font-weight-semibold" for="oldPassword">Kata Sandi Lama:</label>
                            <input type="password" class="form-control @error('oldPassword') is-invalid @enderror"
                                id="oldPassword" name="oldPassword" placeholder="Kata Sandi Lama">
                            @error('oldPassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label class="font-weight-semibold" for="newPassword">Kata Sandi Baru:</label>
                            <input type="password" class="form-control @error('newPassword') is-invalid @enderror"
                                id="newPassword" name="newPassword" placeholder="Kata Sandi Baru">
                            @error('newPassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label class="font-weight-semibold" for="confirmPassword">Konfirmasi Kata Sandi:</label>
                            <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror"
                                id="confirmPassword" name="confirmPassword" placeholder="Konfirmasi Kata Sandi">
                            @error('confirmPassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <button class="btn btn-primary m-t-30">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('#inputImage').change(function() {
                let reader = new FileReader();

                reader.onload = (e) => {
                    $('#previewImage').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });
        </script>
    @endpush
@endsection
