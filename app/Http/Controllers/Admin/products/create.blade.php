@extends('admin.dashboard')

@section('content')
<div class="container mt-4" style="max-width: 800px;">
    <div class="card shadow-sm border-0 p-4">
        <h3 class="mb-4">Add New Product</h3>

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select a Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter product title" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Price ($)</label>
                    <input type="number" step="0.01" name="price" class="form-control" placeholder="0.00" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Stock Quantity</label>
                    <input type="number" name="stock" class="form-control" value="0" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="description" class="form-control" placeholder="Short description">
            </div>

            <div class="mb-3">
                <label class="form-label">Detailed Content</label>
                <textarea name="detail" class="form-control" rows="4" placeholder="Detailed product specifications..."></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3 form-check form-switch">
                <input type="checkbox" name="status" class="form-check-input" value="1" id="statusSwitch" checked>
                <label class="form-check-label" for="statusSwitch">Publish Product Immediately</label>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary px-4">Save Product</button>
            </div>
        </form>
    </div>
</div>
@endsection
