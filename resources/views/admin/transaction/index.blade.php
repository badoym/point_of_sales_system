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
            <h3 class="mb-0">TRANSACTIONS </h3>|
            <p class="mb-0 fw-lighter">Complete list of transaction</p>
        </div>
        <br>
        <div class="card shadow-sm">
            <div class="card-body">
                <br>
                <table id="dataTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">O.R Number</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Cash</th>
                            <th scope="col">Change</th>
                            <th scope="col">Tax(12%)</th>
                            <th scope="col">Sub Total</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($totalsales as $index => $sales)
                        <tr>
                            <th scope="row">{{$index+1}}</th>
                            <td>{{$sales->order_number}}</td>
                            <td>{{ number_format($sales->grand_total, 2) }}</td>
                            <td>{{ number_format($sales->cash, 2) }}</td>
                            <td>{{ number_format($sales->change, 2) }}</td>
                            <td>{{ number_format($sales->vat, 2) }}</td>
                            <td>{{ number_format($sales->subtotal, 2) }}</td>
                            <td>{{ $sales->created_at->format('M d, Y') }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.transaction.view', ['order_number' => $sales->order_number]) }}" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{route('admin.transaction.destroy_sumorder', ['order_number' => $sales->order_number])}}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this order?')">
                                        <i class="bi bi-x-circle"></i>
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
