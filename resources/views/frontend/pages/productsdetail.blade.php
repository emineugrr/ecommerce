
@extends('frontend.layout.layout')

@section('content')

<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0">
                <a href="{{ route('home') }}">Home</a>
                <span class="mx-2 mb-0">/</span>
                <strong class="text-black">{{ $product->title }}</strong>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">


        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">

            <div class="col-md-6">
                <img src="{{ asset($product->image) }}"
                     alt="{{ $product->title }}"
                     class="img-fluid">
            </div>

            <div class="col-md-6">

                <h2 class="text-black">{{ $product->title }}</h2>

                {!! $product->detail !!}

                <p>
                    <strong class="text-primary h4">
                        ${{ number_format($product->price, 2) }}
                    </strong>
                </p>


                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf

                    <div class="mb-1 d-flex">
                        <label for="option-sm" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2">
                                <input type="radio" id="option-sm" name="shop-sizes" value="Small">
                            </span>
                            <span class="d-inline-block text-black">Small</span>
                        </label>

                        <label for="option-md" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2">
                                <input type="radio" id="option-md" name="shop-sizes" value="Medium">
                            </span>
                            <span class="d-inline-block text-black">Medium</span>
                        </label>

                        <label for="option-lg" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2">
                                <input type="radio" id="option-lg" name="shop-sizes" value="Large">
                            </span>
                            <span class="d-inline-block text-black">Large</span>
                        </label>

                        <label for="option-xl" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2">
                                <input type="radio" id="option-xl" name="shop-sizes" value="Extra Large">
                            </span>
                            <span class="d-inline-block text-black">Extra Large</span>
                        </label>
                    </div>

                    <div class="mb-5">
                        <div class="input-group mb-3" style="max-width:120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">
                                    &minus;
                                </button>
                            </div>


                            <input type="text"
                                   name="quantity"
                                   class="form-control text-center"
                                   value="1"
                                   min="1"
                                   max="{{ $product->stock }}">

                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">
                                    &plus;
                                </button>
                            </div>
                        </div>
                    </div>

                    <p>

                        <button type="submit" class="buy-now btn btn-sm btn-primary py-2 px-4 text-uppercase">
                            Add To Cart
                        </button>
                    </p>

                </form>
                

            </div>

        </div>
    </div>
</div>

@endsection
