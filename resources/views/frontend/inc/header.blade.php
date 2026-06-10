@php
    use App\Models\Cart;
    $headerCartItems = collect();
    $headerCartCount = 0;
    $headerCartTotal = 0;

    if (auth()->check()) {
        $headerCartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        $headerCartCount = $headerCartItems->sum('quantity');
        $headerCartTotal = $headerCartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }
@endphp

<header class="site-navbar" role="banner">

  <div class="site-navbar-top">
    <div class="container">
      <div class="row align-items-center">

        <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
          <form action="" class="site-block-top-search">
            <span class="icon icon-search2"></span>
            <input type="text" class="form-control border-0" placeholder="Search">
          </form>
        </div>

        <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
          <div class="site-logo">
            <a href="{{ route('home') }}" class="js-logo-clone">
              {{ config('app.name') }}
            </a>
          </div>
        </div>

        <div class="col-6 col-md-4 order-3 order-md-3 text-right">
          <div class="site-top-icons">
            <ul>

              @auth
                <li class="d-inline-block dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration: none;">
                    <span class="icon icon-person"></span>
                    <span class="d-none d-md-inline" style="font-size: 14px; margin-left: 3px;">
                      Hi, {{ strtok(auth()->user()->name, ' ') }}
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right p-2" style="font-size: 14px; min-width: 150px; z-index: 1050;">
                    <a class="dropdown-item py-2 border-bottom" href="{{ route('cart') }}">My Cart ({{ $headerCartCount }})</a>
                    <a class="dropdown-item py-2 border-bottom" href="{{ route('checkout') }}">Checkout</a>

                    <form action="{{ route('logout') }}" method="POST" class="mt-2 px-2">
                      @csrf
                      <button type="submit" class="btn btn-sm btn-danger w-100" style="font-size: 12px;">
                        Logout
                      </button>
                    </form>
                  </div>
                </li>
              @else
                <li>
                  <a href="{{ route('login') }}" style="text-decoration: none;">
                    <span class="icon icon-person"></span>
                    <span class="d-none d-md-inline" style="font-size: 14px; margin-left: 3px;">Login</span>
                  </a>
                </li>
              @endauth

              <li>
                <a href="#">
                  <span class="icon icon-heart-o"></span>
                </a>
              </li>

              <li>
                <a href="{{ route('cart') }}" class="site-cart" style="text-decoration: none; display: inline-flex; align-items: center;">
                  <span class="icon icon-shopping_cart"></span>
                  <span class="count bg-primary text-white text-center fw-bold" style="font-size: 11px;">
                    {{ $headerCartCount }}
                  </span>
                  <span class="price d-none d-md-inline text-dark fw-bold" style="font-size: 14px; margin-left: 8px;">
                    ${{ number_format($headerCartTotal, 2) }}
                  </span>
                </a>
              </li>

              <li class="d-inline-block d-md-none ml-md-0">
                <a href="#" class="site-menu-toggle js-menu-toggle">
                  <span class="icon-menu"></span>
                </a>
              </li>

            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>

  <nav class="site-navigation text-right text-md-center" role="navigation">
    <div class="container">

      <ul class="site-menu js-clone-nav d-none d-md-block">
        <li class="active">
          <a href="{{ route('home') }}">Home</a>
        </li>

        <li class="has-children">
          <a href="#">Category</a>
          <ul class="dropdown">
            @if (!empty($categories) && $categories->count() > 0)
              @foreach ($categories as $category)
                @if ($category->cat_top == null)
                  <li class="has-children">
                    <a href="#">{{ $category->name }}</a>
                    <ul class="dropdown">
                      @foreach ($categories as $subCategory)
                        @if ($subCategory->cat_top == $category->id)
                          <li><a href="#">{{ $subCategory->name }}</a></li>
                        @endif
                      @endforeach
                    </ul>
                  </li>
                @endif
              @endforeach
            @endif
          </ul>
        </li>

        <li><a href="{{ route('about') }}">About</a></li>
        <li><a href="{{ route('products') }}">Products</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
      </ul>

    </div>
  </nav>

</header>

