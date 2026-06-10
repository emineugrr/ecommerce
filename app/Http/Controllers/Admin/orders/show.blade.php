@extends('admin.dashboard')

@section('content')
<div class="container mt-4" style="max-width: 800px;">
    <div class="card shadow-sm border-0 p-4">
        <h3 class="mb-4">Edit Product: {{ $product->title }}</h3>

        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Title</label>
                <input type="text" name="title" class="form-control" value="{{ $product->title }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Price ($)</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Stock Quantity</label>
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="description" class="form-control" value="{{ $product->description }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Detailed Content</label>
                <textarea name="detail" class="form-control" rows="4">{{ $product->detail }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Image</label>
                @if($product->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="" style="width: 100px; height: 100px; object-fit: cover;" class="rounded border">
                    </div>
                @endif
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3 form-check form-switch">
                <input type="checkbox" name="status" class="form-check-input" value="1" id="statusSwitch" {{ $product->status ? 'checked' : '' }}>
                <label class="form-check-label" for="statusSwitch">Product is Active</label>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-warning px-4">Update Product</button>
            </div>
        </form>
    </div>
</div>
@endsection
