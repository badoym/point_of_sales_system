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
            <h3 class="mb-0">PRODUCT </h3>|
            <p class="mb-0 fw-lighter">Complete list of available food</p>
        </div>
        <br>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{route('admin.product.create')}}" class="btn btn-primary">+ Food</a>
                </div>
                <br>
                <table id="dataTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th></th>
                            <th scope="col">Food</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $index =>  $product)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <th>
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                        alt="{{ $product->productname }}" 
                                        width="60" 
                                        class="w-20 h-20 rounded-full object-cover" /></td>
                                <td>{{ $product->productname }}</td>
                                <td>{{ $product->description }} </td>
                                <td>{{ $product->meal }} </td>
                                <td>{{ $product->saleprice }} </td>
                                <td>
                                    @if($product->stock > 5)
                                        <span class="badge bg-success fs-8">{{$product->stock}} left</span>
                                    @else
                                        <span class="badge bg-danger fs-8">{{$product->stock}} left</span>
                                    @endif
                                </td>
                                <td>{{ $product->unit}} </td>
                                <td>
                                    <a href="{{ route('admin.product.toggleStatus', ['id' => $product->id]) }}" 
                                    onclick="return confirm('Are you sure you want to change the status?')">
                                        @if($product->status == 1)
                                            <span class="badge bg-success fs-8">Available</span>
                                        @else
                                            <span class="badge bg-secondary fs-8">Not Available</span>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.product.edit', ['product' => $product])}}" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                     </a>
                                     <form action="{{ route('admin.product.destory', ['product' => $product]) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this food item?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "pageLength": 5,
            "lengthMenu": [[5, 10, 15, 20, 25, 50, 100], [5, 10, 15, 20, 25, 50, 100]]
        });
    });
</script>
</html>
