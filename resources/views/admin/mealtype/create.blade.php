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
            <h3 class="mb-0">ADD MEAL TYPE </h3>|
            <p class="mb-0 fw-lighter">Fill in the details below to add a new meal type.</p>
        </div>
        <br>
        <div class="card shadow-sm">
            <div class="card-body">
                <form class="row g-3 p-3" action="{{route('admin.mealtype.store')}}" method="POST">
                    @csrf
                    <!-- Food Name -->
                    <div class="col-md-6">
                        <label for="foodName" class="form-label fw-bold">Meal Type</label>
                        <input type="text" name="mealtype" class="form-control" id="foodName" placeholder="Enter food name">
                    </div>

                    <!-- Description -->
                    <div class="col-md-6">
                        <label for="foodDescription" class="form-label fw-bold">Description</label>
                        <input type="text" name="description" class="form-control" id="foodDescription" placeholder="Short description">
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
