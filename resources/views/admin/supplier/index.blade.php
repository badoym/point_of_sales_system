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
            <h3 class="mb-0">SUPPLIER </h3>|
            <p class="mb-0 fw-lighter">Complete list of available supplier</p>
        </div>
        <br>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{route('admin.supplier.create')}}" class="btn btn-primary">+ Supplier</a>
                </div>
                <br>
                <table id="dataTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Supplier</th>
                            <th scope="col">Contact No</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Address</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $index => $supplier)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$supplier->suppliername}}</td>
                                <td>{{$supplier->contactno}}</td>
                                <td>{{$supplier->emailaddress}}</td>
                                <td>{{$supplier->address}}</td>
                                <td>
                                    <a href="{{ route('admin.supplier.toggleStatus', ['id' => $supplier->id]) }}" 
                                    onclick="return confirm('Are you sure you want to change the status?')">
                                        @if($supplier->status == 1)
                                            <span class="badge bg-success fs-8">Active</span>
                                        @else
                                            <span class="badge bg-secondary fs-8">Not Active</span>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{route('admin.supplier.edit', ['supplier' => $supplier])}}" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                     </a>
                                     <form action="{{route('admin.supplier.destroy', ['supplier' => $supplier])}}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this supplier item?')">
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
            "pageLength": 10,
            "lengthMenu": [[10, 15, 20, 25, 50, 100], [10, 15, 20, 25, 50, 100]]
        });
    });
</script>
</html>
