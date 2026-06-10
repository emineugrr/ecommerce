<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
<div class="d-flex" id="wrapper">

    <div class="bg-dark text-white" id="sidebar-wrapper" style="min-width: 250px; min-height: 100vh;">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold text-uppercase border-bottom border-secondary">
            Control Panel
        </div>
        <div class="list-group list-group-flush mt-3">
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3 px-4">
                <i class="fa fa-tachometer-alt me-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.product.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3 px-4">
                <i class="fa fa-box me-2"></i> Product Management
            </a>
            <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3 px-4">
                <i class="fa fa-shopping-bag me-2"></i> Order Management
            </a>
            <a href="{{ route('home') }}" class="list-group-item list-group-item-action bg-dark text-white border-0 py-3 px-4" target="_blank">
                <i class="fa fa-eye me-2"></i> View Website
            </a>
        </div>
    </div>

    <div id="page-content-wrapper" class="w-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 py-3 shadow-sm">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Dashboard Overview</span>
                <div class="ms-auto">
                    <span class="text-muted">Logged in as: <strong>{{ auth()->user()->name }}</strong></span>
                </div>
            </div>
        </nav>

        <div class="container-fluid p-4">
            @yield('content')
        </div>
    </div>

</div>
</body>
</html>
