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
            <h3 class="mb-0">DASHBOARD </h3>|
            <p class="mb-0 fw-lighter">Overview of Store Performance</p>
        </div>
        <br>
        <br>
        <!-- Dashboard Cards -->
        <div class="row g-3">
            <div class="col-md">
                <div class="card p-3 rounded-2 shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-gold text-dark me-3">
                            <i class="bi bi-currency-exchange"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">₱{{ number_format($totalsales, 2) }}</h5>
                            <small class="text-muted">Total Sales</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md">
                <div class="card p-3 rounded-2 shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-dark text-light me-3">
                            <i class="bi bi-basket"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">{{ $totalproduct }}</h5>
                            <small class="text-muted">Food Items</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md">
                <div class="card p-3 rounded-2 shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-secondary text-white me-3">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">{{$totalcustomer}}</h5>
                            <small class="text-muted">Customers</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md">
                <div class="card p-3 rounded-2 shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-primary text-white me-3">
                            <i class="bi bi-cart-check"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">{{$totaltransaction}}</h5>
                            <small class="text-muted">Transactions</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row g-3">
            <div class="col-md">
                <div class="card p-2 rounded-2 shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-info text-dark me-3">
                            <i class="bi bi-truck"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">{{$totalsupplier}}</h5>
                            <small class="text-muted">Total Supplier</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md">
                <div class="card p-2 rounded-2 shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-warning text-light me-3">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">{{ $totallowstock }}</h5>
                            <small class="text-muted">Low Stock</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md">
                <div class="card p-2 rounded-2 shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-success text-white me-3">
                            <i class="bi bi-bar-chart-fill"></i> <!-- changed icon -->
                        </div>
                        <div>
                            @if($totalmostsoldfood)
                                <h5 class="mb-0 fw-bold">{{ $totalmostsoldfood->product->productname }}</h5>
                                <small class="text-muted">
                                    Most Sold
                                </small>
                            @else
                                <h5 class="mb-0 fw-bold">0</h5>
                                <small class="text-muted">No sales this week</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md">
                <div class="card p-2 rounded-2 shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-danger text-white me-3">
                            <i class="bi bi-receipt-cutoff"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">45</h5>
                            <small class="text-muted">Transactions</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md">
                <div class="card p-2 rounded-2 shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-secondary text-white me-3">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">{{$totaluser}}</h5>
                            <small class="text-muted">Total User</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <!-- Chart -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="text-lg font-bold text-gray-700 text-center mb-3">Annual Sales</h3>

                <div class="text-end mb-4">
                    <label for="yearFilter" class="mr-2 text-sm font-medium text-gray-600">Select Year:</label>
                    <select id="yearFilter" 
                        class="px-2 py-1 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        @foreach(array_keys($yearlySales) as $year)
                            <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <canvas id="salesChart" style="min-height: 250px; height: 300px;"></canvas>
            </div>
        </div>
    </div>
</body>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');

    // Pass PHP data to JS
    const yearlySales = @json($yearlySales);
    const currentYear = @json($currentYear);

    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'January','February','March','April','May','June',
                'July','August','September','October','November','December'
            ],
            datasets: [{
                label: 'Monthly Sales (₱)',
                data: yearlySales[currentYear], // default to current year
                backgroundColor: '#0be881',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Update chart when year changes
    document.getElementById('yearFilter').addEventListener('change', function() {
        const selectedYear = this.value;
        salesChart.data.datasets[0].data = yearlySales[selectedYear];
        salesChart.update();
    });
</script>


</html>
