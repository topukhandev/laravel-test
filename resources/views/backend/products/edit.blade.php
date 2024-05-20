@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Product</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity"
                    value="{{ old('quantity', $product->quantity) }}" min="0" required>
                @error('quantity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group position-relative mb-3">
                <label for="category-name" class="form-label">Status</label>
                <select name="status" id="" class="select2 form-control">
                    <option {{ $product->status == '1' ? 'selected' : '' }} value="1">Active</option>
                    <option {{ $product->status == '0' ? 'selected' : '' }} value="0">InActive</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Images</label>
                <input type="file" class="form-control" id="images" name="images[]" multiple>
                @error('images')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @error('images.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <span id="imgRemoveMsg" style="color: rgb(229, 53, 53); display: none">Image deleted (refresh page)</span>
            @foreach ($product->getMedia('images') as $key => $item)
                <div class="dragDrop-area">
                    {{-- <input type="file" name="images[]" class="image-upload" accept="image/*"> --}}
                    {{-- <label for="image-upload" class="upload-label">
                        <img src="{{ asset('backend') }}/img_upload.svg" alt="" class="w-auto h-auto">
                    </label> --}}
                    <div class="image-preview-container" style="{{ $item ? '' : '' }}">
                        <img class="image-preview" width="100px" height="auto" src="{{ $item->getUrl() }}"
                            alt="Image Preview">
                        <img src="{{ asset('backend/img_upload_close.svg') }}"
                            onclick="deleteImage('{{ $product->id }}', '{{ $item->id }}')" alt=""
                            class="close-icon close-icon-ajax" style="{{ $item ? '' : '' }}">
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        function deleteImage(id, itemId) {
            $.ajax({
                type: 'GET',
                url: `/product/image/remove/${id}/${itemId}`,
                success: function(response) {
                    imgRemoveMsg.style.display = 'block';
                    setInterval(() => {
                        imgRemoveMsg.style.display = 'none';
                    }, 2500);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error('Error deleting item:', error);
                }
            });
        }
    </script>
@endpush
