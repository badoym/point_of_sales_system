<!DOCTYPE html>
<html lang="en">

@include('layouts.head')

<body>
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Congratulations!',
                    text: '{{ session("success") }}',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                });
            });
        </script>
    @endif
    
    <!-- Top Navbar -->
    @include('layouts.navbar')

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="main">
        <div class="d-flex align-items-center gap-2">
            <h3 class="mb-0">INVETORY REPORT </h3>|
            <p class="mb-0 fw-lighter">Complete list of Invetory Report</p>
        </div>
        <br>
        <div class="row g-3">
            <div class="col-md">
                <div class="card p-3 rounded-2 shadow-sm filter-card" data-filter="all">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-success text-light me-3">
                            <i class="bi bi-box-seam"></i> 
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">{{$totalproduct}}</h5>
                            <small class="text-muted">Total Food Items</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md">
                <div class="card p-3 rounded-2 shadow-sm filter-card" data-filter="low-stock">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-warning text-light me-3">
                            <i class="bi bi-exclamation-triangle"></i> 
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">{{$totallowstock}}</h5>
                            <small class="text-muted">Low-stock Items</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md">
                <div class="card p-3 rounded-2 shadow-sm filter-card" data-filter="out-stock">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-danger text-light me-3">
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">{{$totaloutstock}}</h5>
                            <small class="text-muted">Out-of-stock Items</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md">
                <div class="card p-3 rounded-2 shadow-sm filter-card" data-filter="most-stock">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-primary text-white me-3">
                             <i class="bi bi-stack"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">{{$totalmoststock}}</h5>
                            <small class="text-muted">Most Stocked Items</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{route('admin.product.create')}}" class="btn btn-primary">Print</a>
                </div>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $index => $product)
                        <tr class="
                            @if($product->stock == 0) out-stock
                            @elseif($product->stock <= 10) low-stock
                            @elseif($product->stock >= 11) most-stock
                            @else normal-stock
                            @endif
                        ">
                            <td>{{$index+1}}</td>
                            <td>{{$product->productname}}</td>
                            <td>{{$product->category_name}}</td>
                            <td>{{$product->saleprice}}</td>
                            <td>{{$product->unit}}</td>
                            <td>
                                @if($product->stock >= 11 )
                                    <span class="badge bg-primary fs-8 d-inline-block text-center" style="width:60px;">{{$product->stock}} Left</span>
                                @elseif($product->stock <= 10 && $product->stock >= 1)
                                    <span class="badge bg-warning text-dark fs-8 d-inline-block text-center" style="width:60px;">{{$product->stock}} Left</span>
                                @elseif($product->stock == 0)
                                    <span class="badge bg-danger fs-8 d-inline-block text-center" style="width:60px;">{{$product->stock}} Left</span>
                                @endif
                            </td>
                            <td>
                                @if($product->status == 1)
                                    <span class="badge bg-success fs-8 fs-8 d-inline-block text-center" style="width:92px;" >Available</span>
                                @else
                                    <span class="badge bg-secondary fs-8">Not Available</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
    const cards = document.querySelectorAll('.filter-card');
    const rows = document.querySelectorAll('table tbody tr');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            const filter = card.getAttribute('data-filter');

            rows.forEach(row => {
                if(filter === 'all') {
                    row.style.display = '';
                } else if(row.classList.contains(filter)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>

</html>
