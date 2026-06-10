<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Checkout</h2>

    <div class="row">
        <div class="col-md-7">
            <div class="card p-4 border-0 shadow-sm mb-4">
                <h4 class="mb-3">Shipping Details</h4>
                <form action="{{ route('checkout.place') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ auth()->user()->email ?? '' }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Full Address</label>
                        <textarea name="address" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" class="form-control">
                        </div>
                    </div>

                    <h4 class="mt-4 mb-3">Shipping Method</h4>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="shipping_method" value="Free Shipping" checked>
                        <label class="form-check-label">Free Shipping ($0.00)</label>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="shipping_method" value="Standard Shipping">
                        <label class="form-check-label">Standard Shipping ($4.00)</label>
                    </div>

                    <h4 class="mt-4 mb-3">Payment Method</h4>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="radio" name="payment_method" value="Cash on Delivery" checked>
                        <label class="form-check-label">Cash on Delivery / Bank Transfer</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100">Place Order</button>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card p-4 border-0 shadow-sm text-bg-dark">
                <h4 class="mb-3 text-white">Order Summary</h4>
                <ul class="list-group list-group-flush mb-3">
                    @foreach($cartItems as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center text-bg-dark border-secondary">
                            <div>
                                <h6>{{ $item->product->title }}</h6>
                                <small class="text-muted">Qty: {{ $item->quantity }}</small>
                            </div>
                            <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="d-flex justify-content-between fw-bold mt-2 fs-5">
                    <span>Total Amount:</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
