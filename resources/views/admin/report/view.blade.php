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
            <h3 class="mb-0">SALES REPORT </h3>|
            <p class="mb-0 fw-lighter">Complete list of Sales Report</p>
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
                            <th scope="col">O.R Number</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Cash</th>
                            <th scope="col">Change</th>
                            <th scope="col">Tax(12%)</th>
                            <th scope="col">Sub Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">O.R. Number</th>
                                <th scope="col">Food Item</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $index => $sales)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <th>{{$sales->order_number}}</th>
                                <th>{{$sales->product_name}}</th>
                                <th>{{number_format($sales->price, 2)}}</th>
                                <th>{{$sales->qty}}</th>
                                <th>{{number_format($sales->total, 2)}}</th>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5"><strong>Total Amount:</strong></td>
                                <td><strong>{{ number_format($totalsales, 2) }}</strong></td>
                            </tr>
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
