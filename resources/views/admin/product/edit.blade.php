<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body>
    <!-- Top Navbar -->
    @include('layouts.navbar')

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main">
        <div class="d-flex align-items-center gap-2">
            <h3 class="mb-0">UPDATE PRODUCT </h3>|
            <p class="mb-0 fw-lighter">Modify food information</p>
        </div>
        <br>
        <div class="card shadow-sm">
            <div class="card-body">
                <form class="row g-3 p-3" action="{{route('admin.product.update', ['product' => $products])}}" method="post">
                    @csrf
                    @method('put')
                    <!-- Food Name -->
                    <div class="col-md-4">
                        <label for="foodName" class="form-label fw-bold">Food</label>
                        <input type="text" name="productname" class="form-control" id="foodName"  value="{{$products->productname}}">
                    </div>

                    <!-- Description -->
                    <div class="col-md-8">
                        <label for="foodDescription" class="form-label fw-bold">Description</label>
                        <input type="text" name="description" class="form-control" id="foodDescription" value="{{$products->description}}">
                    </div>

                    <!-- Category -->
                    <div class="col-md-6">
                        <label for="foodCategory" class="form-label fw-bold">Category</label>
                        <select id="foodCategory" name="category" class="form-select">
                            <option disabled>Choose...</option>
                            <option {{ $products->category == 'Main Dish' ? 'selected' : '' }}>Main Dish</option>
                            <option {{ $products->category == 'Drinks' ? 'selected' : '' }}>Drinks</option>
                            <option {{ $products->category == 'Dessert' ? 'selected' : '' }}>Dessert</option>
                            <option {{ $products->category == 'Snacks' ? 'selected' : '' }}>Snacks</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div class="col-md-6">
                        <label for="foodPrice" class="form-label fw-bold">Price</label>
                        <input type="number" name="saleprice" class="form-control" id="foodPrice" value="{{$products->saleprice}}">
                    </div>

                    <!-- Stock -->
                    <div class="col-md-6">
                        <label for="foodStock" class="form-label fw-bold">Stock</label>
                        <input type="number" name="stock" class="form-control" id="foodStock" value="{{$products->stock}}">
                    </div>

                    <!-- Unit -->
                    <div class="col-md-6">
                        <label for="foodUnit" class="form-label fw-bold">Unit</label>
                        <input type="text" name="unit" class="form-control" id="foodUnit" value="{{$products->unit}}">
                    </div>

                    <!-- Submit -->
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Update Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
