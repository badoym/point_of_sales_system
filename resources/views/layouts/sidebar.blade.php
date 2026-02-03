<div class="sidebar">
    <img src="{{ asset('image/logo.png') }}" alt="Jewelry Logo" width="60" class="mt-3 mx-auto d-block">
    <h5 class="text-center mt-1 mb-0 text-light">TUSLOB BUWA</h5>
    <h6 class="text-center mt-1 mb-0 text-light">De Bais</h6>
    <br>
    <a href="{{ route('admin.dashboard.index') }}" 
       class="{{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
    </a>

    <span class="nav-header">Food Management</span>
    <a href="{{ route('admin.product.index') }}" 
        class="{{ request()->routeIs('admin.product.index', 'admin.product.create', 'admin.product.edit') ? 'active' : '' }}">
        <i class="bi bi-basket me-2"></i> Food Items
    </a>

    <a href="{{route('admin.mealtype.index')}}" 
       class="{{ request()->routeIs('admin.mealtype.index', 'admin.mealtype.create', 'admin.mealtype.edit') ? 'active' : '' }}">
        <i class="bi bi-tags me-2"></i> Meal Type
    </a>
    
    <a href="{{ route('admin.supplier.index') }}" 
       class="{{ request()->routeIs('admin.supplier.*') ? 'active' : '' }}">
        <i class="bi bi-truck me-2"></i> Suppliers
    </a>

    <span class="nav-header">Customer Management</span>
    <a href="{{ route('admin.transaction.index')}}" 
       class="{{ request()->routeIs('admin.transaction.*') ? 'active' : '' }}">
        <i class="bi bi-cart-check me-2"></i> Transactions
    </a>
    <a href="" 
       class="">
        <i class="bi bi-people-fill me-2"></i> Customers
    </a>

    <span class="nav-header">Analytics</span>
    <a href="{{ route('admin.sales.report.index') }}" 
       class="{{ request()->routeIs('admin.sales.report.*') ? 'active' : '' }}">
        <i class="bi bi-graph-up-arrow me-2"></i> Sales Report
    </a>
    <a href="{{ route('admin.inventory.index') }}" 
       class="{{ request()->routeIs('admin.inventory.*') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-text me-2"></i> Inventory Report
    </a>

    <span class="nav-header">User</span>
    <a href="" 
       class="">
        <i class="bi bi-cart-check me-2"></i> Accounts
    </a>
</div>
