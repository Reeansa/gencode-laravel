@extends('administrator.template')
@section('title', 'Admin User')
@section('content')
{{ Breadcrumbs::render('user.edit', $user) }}
    <div class="container">
        <div class="tab-content m-t-15">
            <div class="tab-pane fade show active" id="tab-account">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informasi Dasar User</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.update-image', $user->id) }}" method="POST" id="image-upload"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="media align-items-center">
                                <div class="avatar avatar-image  m-h-10 m-r-15" style="height: 80px; width: 80px">
                                    <img src="@if ($user->image) {{ asset('administrator/storage/' . $user->image) }} @else {{ asset('administrator/assets/img/profiles/thumb-1.jpg') }} @endif"
                                        id="previewImage" alt="{{ $user->first_name }}"
                                        style="object-fit: cover; object-position: center;" >
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
                        <form action="{{ route('user.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-semibold" for="firstName">Nama Depan:</label>
                                    <input type="text" class="form-control @error('firstName') is-invalid @enderror" id="firstName" name="firstName"
                                        placeholder="First Name" value="{{ old('firstName', $user->first_name) }}">
                                    @error('firstName')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-semibold" for="lastName">Nama Belakang:</label>
                                    <input type="text" class="form-control @error('lastName') is-invalid @enderror" id="lastName" name="lastName"
                                        placeholder="lastName" value="{{ old('lastName', $user->last_name) }}">
                                    @error('lastName')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label class="font-weight-semibold" for="email">Email:</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                        placeholder="Email" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold" for="status">Status:</label>
                                    <div class="m-b-15">
                                        <select class="select2 @error('status') is-invalid @enderror" name="status">
                                            @if ($user->status == 1)
                                                <option value="1" selected>Aktif</option>
                                                <option value="0">Tidak Aktif</option>
                                            @else
                                                <option value="1">Aktif</option>
                                                <option value="0" selected>Tidak Aktif</option>
                                            @endif
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold" for="phone">Nomor HP:</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                        placeholder="phone" value="{{ old('phone', $user->phone) }}">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="font-weight-semibold" for="role">Peran:</label>
                                    <div class="m-b-15">
                                        <select class="select2 @error('role') is-invalid @enderror" name="role">
                                            @if ($user->roles_id == 1)
                                                <option value="1" selected>Super Administrator</option>
                                                <option value="2">Seller</option>
                                            @else
                                                <option value="1">Super Administrator</option>
                                                <option value="2" selected>Seller</option>
                                            @endif
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="address">Alamat:</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" cols="30" rows="4">{{ old('address', $user->address) }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Kirim</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ubah Kata Sandi</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.update-password', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold" for="oldPassword">Kata Sandi Lama:</label>
                                    <input type="password" class="form-control @error('oldPassword') is-invalid @enderror" id="oldPassword" name="oldPassword"
                                        placeholder="Old Password">
                                    @error('oldPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold" for="newPassword">Kata Sandi Baru:</label>
                                    <input type="password" class="form-control @error('newPassword') is-invalid @enderror" id="newPassword" name="newPassword"
                                        placeholder="New Password">
                                    @error('newPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold" for="confirmPassword">Konfirmasi Kata Sandi:</label>
                                    <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror" id="confirmPassword"
                                        name="confirmPassword" placeholder="Confirm Password">
                                    @error('confirmPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-primary m-t-30">Ubah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('administrator/assets/vendors/select2/select2.min.js') }}"></script>
        <script>
            $('.select2').select2();
        </script>
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
