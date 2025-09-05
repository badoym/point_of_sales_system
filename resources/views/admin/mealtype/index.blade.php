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
            <h3 class="mb-0">MEAL TYPE </h3>|
            <p class="mb-0 fw-lighter">Complete list of available meal type</p>
        </div>
        <br>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{route('admin.mealtype.create')}}" class="btn btn-primary">+ Meal Type</a>
                </div>
                <br>
                <table id="dataTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Food Type</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Item Count</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mealtypes as $index => $mealtype)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$mealtype->mealtype}}</td>
                            <td>{{$mealtype->description}}</td>
                            <td>
                                <a href="{{ route('admin.mealtype.toggleStatus', ['id' => $mealtype->id]) }}" 
                                    onclick="return confirm('Are you sure you want to change the status?')">
                                    @if($mealtype->status == 1)
                                        <span class="badge bg-success fs-8">Available</span>
                                    @else
                                        <span class="badge bg-secondary fs-8">Not Available</span>
                                    @endif
                                </a>
                            </td>
                            <td>5 (Gam-on pa)</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{route('admin.mealtype.edit', ['mealtype' => $mealtype])}}" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{route('admin.mealtype.destroy', ['mealtype' => $mealtype])}}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this meal type item?')">
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
