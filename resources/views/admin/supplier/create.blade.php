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
            <h3 class="mb-0">ADD SUPPLIER </h3>|
            <p class="mb-0 fw-lighter">Fill in the details below to add a new supplier.</p>
        </div>
        <br>
        <div class="card shadow-sm">
            <div class="card-body">
                <form class="row g-3 p-3" action="{{route('admin.supplier.store')}}" method="POST">
                    @csrf
                    <!-- Supplier Name -->
                    <div class="col-md-6">
                        <label for="foodName" class="form-label fw-bold">Supplier</label>
                        <input type="text" name="suppliername" class="form-control" id="foodName" placeholder="Enter supplier name">
                    </div>

                    <!-- Contact No -->
                    <div class="col-md-6">
                        <label for="foodDescription" class="form-label fw-bold">Contract No.</label>
                        <input type="number" name="contactno" class="form-control" id="foodDescription" placeholder="Enter supplier Contact No">
                    </div>

                    <!-- Email Address -->
                    <div class="col-md-6">
                        <label for="foodPrice" class="form-label fw-bold">Email Address</label>
                        <input type="email" name="emailaddress" class="form-control" id="foodPrice" placeholder="₱0.00">
                    </div>

                    <!-- Address -->
                    <div class="col-md-6">
                        <label for="foodStock" class="form-label fw-bold">Address</label>
                        <input type="text" name="address" class="form-control" id="foodStock" placeholder="Available quantity">
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
