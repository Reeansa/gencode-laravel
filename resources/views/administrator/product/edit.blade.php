@extends('administrator.template')
@section('title', 'Add Product')
@section('content')
    {{ Breadcrumbs::render('product.edit', $product) }}
    <div class="d-flex flex-column align-items-center justify-content-center bg-white p-50 shadow-sm">
        <form class="w-50" action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="d-flex align-items-center mb-5" style="gap: 1rem;">
                <div style="width: 200px; height: 200px">
                    @if ($product->productImage->isNotEmpty())
                        <img class="rounded-lg"
                            src="{{ asset('administrator/storage/' . $product->productImage->first()->image) }}"
                            alt="{{ $product->name }}" id="previewImage" width="100%" height="100%"
                            style="object-fit: cover; object-position: center;">
                    @endif
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile"
                        name="image[]" value="{{ $product->image }}" multiple accept="image/*">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="productName">Product Name</label>
                    <input type="text" class="form-control @error('productName') is-invalid @enderror" name="productName"
                        id="productName" placeholder="Product Name" value="{{ old('productName', $product->name) }}">
                    @error('productName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                        id="price" placeholder="Price" value="{{ old('price', $product->price) }}">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="8" class="form-control @error('description') is-invalid @enderror" id="description"
                    name="description" placeholder="Description Product">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <h1>Foto Produk</h1>
        <div class="d-flex flex-wrap align-items-center mt-5" style="gap: 0.5rem;">
            @foreach ($product->productImage as $image)
                <div>
                    <form
                        action="{{ route('product.delete-image', ['product' => $product->id, 'productImage' => $image->id]) }}"
                        method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-icon btn-danger btn-rounded btn-tone position-relative"
                            style="top: 3rem; z-index: 1; left: 75%;">
                            <i class="anticon anticon-close"></i>
                        </button>
                    </form>
                    <div class="card" style="max-width: 200px; max-height: 200px">
                        <img class="card-img-top" style="height: 200px; object-fit: cover; object-position: center;"
                            src="{{ asset('administrator/storage/' . $image->image) }}" alt="{{ $product->name }}">
                    </div>

                </div>
            @endforeach
        </div>
    </div>
    @push('scripts')
        <script>
            $('#customFile').change(function() {
                let reader = new FileReader();

                reader.onload = (e) => {
                    $('#previewImage').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });
            
        </script>
    @endpush

@endsection
