@extends('administrator.template')
@section('title', 'Admin User')
@section('content')
{{ Breadcrumbs::render('user') }}
    <div class="card">
        <div class="card-body">
            <div class="row m-b-30">
                <div class="col-lg-12 text-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="anticon anticon-plus-circle m-r-5"></i>
                        Tambah Seller
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover e-commerce-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($user as $a)
                            @if ($a->id != Auth::id())
                                <tr>
                                    <td>
                                        {{ $no++ }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-image avatar-sm m-r-10">
                                                <img onclick="window.location.href='{{ route('profile.show', $a->id) }}'" src="@if ($a->image) {{ asset('administrator/storage/' . $a->image) }} @else {{ asset('administrator/assets/img/profiles/thumb-1.jpg') }} @endif"
                                                    style="object-position: center; object-fit: cover; cursor: pointer;"
                                                    alt="{{ $a->first_name }} {{ $a->last_name }}" data-toggle="tooltip" data-placement="top" title="Klik untuk melihat detail profil pengguna">>
                                            </div>
                                            <h6 class="m-b-0 m-l-10">{{ $a->first_name }} {{ $a->last_name }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($a->status == 1)
                                            <form action="{{ route('user.update-status', $a->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="badge badge-pill badge-green"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Klik ini untuk mengubah status">Aktif</button>
                                            </form>
                                        @else
                                            <form action="{{ route('user.update-status', $a->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="badge badge-pill badge-red"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Klik ini untuk mengubah status">Tidak Aktif</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>{{ $a->email }}</td>
                                    <td>{{ $a->roles->name }}</td>
                                    <td class="text-right">
                                        <div class="d-flex" style="gap: 0.5rem;">
                                            <a href="{{ route('user.edit', $a->id) }}"
                                                class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                                <i class="anticon anticon-edit"></i>
                                            </a>
                                            <form action="{{ route('user.destroy', $a->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-icon btn-hover btn-sm btn-rounded">
                                                    <i class="anticon anticon-delete"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Add -->
    <div class="modal fade" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Akun</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="d-flex flex-column modal-body" style="gap: 1rem;">
                        <div class="form-row">
                            <div class="col">
                                <label for="email">Nama Depan</label>
                                <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror" id="firstName" value="{{ old('firstName') }}">
                                @error('firstName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="email">Nama Belakang</label>
                                <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror" id="lastName" value="{{ old('lastName') }}">
                                @error('lastName')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="m-b-15">
                            <label for="email">Pilih Peran</label>
                            <select class="select2" name="roles">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror" id="confirmPassword" name="confirmPassword" >
                            @error('confirmPassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('administrator/assets/js/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('administrator/assets/js/datatables/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('administrator/assets/js/pages/e-commerce-order-list.js') }}"></script>
        <script src="{{ asset('administrator/assets/vendors/select2/select2.min.js') }}"></script>
        <script>
            $('.select2').select2();
        </script>
    @endpush
@endsection
