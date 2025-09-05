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
            <h3 class="mb-0">ADD PRODUCT </h3>|
            <p class="mb-0 fw-lighter">Fill in the details below to add a new product.</p>
        </div>
        <br>
        <div class="card shadow-sm">
            <div class="card-body">
                <form class="row g-3 p-3" action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Food Name -->
                    <div class="col-md-4">
                        <label for="foodName" class="form-label fw-bold">Food</label>
                        <input type="text" name="productname" class="form-control" id="foodName" placeholder="Enter food name">
                    </div>

                    <!-- Description -->
                    <div class="col-md-8">
                        <label for="foodDescription" class="form-label fw-bold">Description</label>
                        <input type="text" name="description" class="form-control" id="foodDescription" placeholder="Short description">
                    </div>

                    <!-- Category -->
                    <div class="col-md-6">
                        <label for="foodCategory" class="form-label fw-bold">Meal Type</label>
                        <select id="foodCategory" name="category" class="form-select">
                            <option selected disabled>Choose...</option>
                            @foreach($mealtype as $meal)
                                <option value="{{$meal->id}}">{{$meal->mealtype}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price -->
                    <div class="col-md-6">
                        <label for="foodPrice" class="form-label fw-bold">Price</label>
                        <input type="number" name="saleprice" class="form-control" id="foodPrice" placeholder="₱0.00">
                    </div>

                    <!-- Stock -->
                    <div class="col-md-6">
                        <label for="foodStock" class="form-label fw-bold">Stock</label>
                        <input type="number" name="stock" class="form-control" id="foodStock" placeholder="Available quantity">
                    </div>

                    <!-- Unit -->
                    <div class="col-md-6">
                        <label for="foodUnit" class="form-label fw-bold">Unit</label>
                        <input type="text" name="unit" class="form-control" id="foodUnit" placeholder="e.g. per plate, per cup">
                    </div>

                        <!-- Image Upload -->
                    <div class="col-md-12">
                        <label for="foodImage" class="form-label fw-bold">Food Image</label>
                        <input type="file" name="image" class="form-control" id="foodImage" accept="image/*">
                    </div>

                    <!-- Submit -->
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
