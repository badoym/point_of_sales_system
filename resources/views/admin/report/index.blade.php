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
                <form method="GET" action="{{ route('admin.sales.report.index') }}" id="dateFilterForm">
                    <div class="row g-3 p-3">
                        <div class="col-md-3">
                            <label for="datefrom" class="form-label fw-bold">From:</label>
                            <input type="date" name="datefrom" class="form-control" id="datefrom" value="{{ request('datefrom') }}">
                        </div>

                        <div class="col-md-3">
                            <label for="dateto" class="form-label fw-bold">To:</label>
                            <input type="date" name="dateto" class="form-control" id="dateto" value="{{ request('dateto') }}">
                        </div>
                    </div>
                </form>

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
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.sales.report.view', ['order_number' => $sales->order_number]) }}" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"><strong>Total Amount:</strong></td>
                            <td><strong>{{ number_format($totalGrand, 2) }}</strong></td>
                            <td><strong></strong></td>
                            <td><strong></strong></td>
                            <td colspan="1"><strong>{{ number_format($totalTax, 2) }}</strong></td>
                            <td colspan="1"><strong>{{ number_format($totalSub, 2) }}</strong></td>
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

    const form = document.getElementById('dateFilterForm');
    document.getElementById('datefrom').addEventListener('change', () => form.submit());
    document.getElementById('dateto').addEventListener('change', () => form.submit());
</script>
</html>
