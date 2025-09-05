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
            <h3 class="mb-0">UPDATE SUPPLIER </h3>|
            <p class="mb-0 fw-lighter">Modify supplier information</p>
        </div>
        <br>
        <div class="card shadow-sm">
            <div class="card-body">
                <form class="row g-3 p-3" action="{{route('admin.supplier.update', ['supplier' => $suppliers])}}" method="POST">
                    @csrf
                    @method('put')
                    <!-- Supplier Name -->
                    <div class="col-md-6">
                        <label for="foodName" class="form-label fw-bold">Supplier</label>
                        <input type="text" name="suppliername" class="form-control" id="foodName" value="{{$suppliers->suppliername}}">
                    </div>

                    <!-- Contact No -->
                    <div class="col-md-6">
                        <label for="foodDescription" class="form-label fw-bold">Contract No.</label>
                        <input type="number" name="contactno" class="form-control" id="foodDescription" value="{{$suppliers->contactno}}">
                    </div>

                    <!-- Email Address -->
                    <div class="col-md-6">
                        <label for="foodPrice" class="form-label fw-bold">Email Address</label>
                        <input type="email" name="emailaddress" class="form-control" id="foodPrice" value="{{$suppliers->emailaddress}}">
                    </div>

                    <!-- Address -->
                    <div class="col-md-6">
                        <label for="foodStock" class="form-label fw-bold">Address</label>
                        <input type="text" name="address" class="form-control" id="foodStock" value="{{$suppliers->address}}">
                    </div>

                    <!-- Submit -->
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
