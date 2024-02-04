@extends('administrator.template')
@section('title', 'Product')
@section('content')
    {{ Breadcrumbs::render('product') }}
    <div class="card">
        <div class="card-body">
            <div class="row m-b-30">
                <div class="col-lg-12 text-right">
                    <a href="{{ route('product.create') }}"><button class="btn btn-primary">
                            <i class="anticon anticon-plus-circle m-r-5"></i>
                            <span>Tambah Produk</span>
                        </button></a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover e-commerce-table">
                    <thead>
                        <tr>
                            <th>
                                <div class="checkbox">
                                    <input id="checkAll" type="checkbox">
                                    <label for="checkAll" class="m-b-0"></label>
                                </div>
                            </th>
                            <th>ID</th>
                            <th>Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input id="check-item-1" type="checkbox">
                                        <label for="check-item-1" class="m-b-0"></label>
                                    </div>
                                </td>
                                <td>
                                    {{ $i }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <div class="avatar avatar-icon avatar-square">
                                            @if ($product->productImage->isNotEmpty())
                                                <img src="{{ asset('administrator/storage/' . $product->productImage->first()->image) }}"
                                                    width="100%" height="100%"
                                                    style="object-fit: cover; object-position: center;"
                                                    alt="{{ $product->name }}">
                                            @endif
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <h6 class="m-b-0 m-l-10">{{ $product->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->description }}</td>
                                <td>Rp. {{ number_format($product->price) }}</td>
                                <td>
                                    @if ($product->is_new == true)
                                        <span class="badge badge-pill badge-success">New</span>
                                    @else
                                        <span class="badge badge-pill badge-default">Old</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="d-flex">
                                        <a href="{{ route('product.edit', $product->id) }}">
                                            <button class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                                <i class="anticon anticon-edit"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-hover btn-sm btn-rounded">
                                                <i class="anticon anticon-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @php $i++; @endphp
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('administrator/assets/js/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('administrator/assets/js/datatables/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ asset('administrator/assets/js/pages/e-commerce-order-list.js') }}"></script>
    @endpush
@endsection
