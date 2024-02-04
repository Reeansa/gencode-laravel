@extends('administrator.template')
@section('title', 'Add Product')
@section('content')
    {{ Breadcrumbs::render('product.create') }}
    <div class="d-flex align-items-center justify-content-center bg-white p-50 shadow-sm">
        <form class="w-50" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="d-flex align-items-center mb-5" style="gap: 1rem;">
                <div style="width: 200px; height: 200px">
                    <img class="rounded-lg" src="{{ asset('administrator/assets/img/profiles/thumb-1.jpg') }}" alt=""
                        id="previewImage" width="100%" height="100%" style="object-fit: cover; object-position: center;">
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile"
                        name="image[]" multiple accept="image/*">
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
                        id="productName" placeholder="Product Name" value="{{ old('productName') }}">
                    @error('productName')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                        id="price" placeholder="Price" value="{{ old('price') }}">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"> {{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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
