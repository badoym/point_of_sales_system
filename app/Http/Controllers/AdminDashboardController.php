<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sumorder;
use App\Models\Supplier;
use App\Models\Order;
use App\Models\User;

class AdminDashboardController extends Controller{

    public function index(){
        $currentYear = now()->year;

        $totalproduct      = Product::count();
        $totaltransaction  = Sumorder::whereDate('created_at', now())->count();
        $totalcustomer     = Sumorder::whereDate('created_at', now())->count();
        $totalsales        = Sumorder::whereDate('created_at', now())->sum('grand_total');
        $totalsupplier     = Supplier::where('status', 1)->count();
        $totallowstock     = Product::where('stock', '<', 5)->count();
        $totalmostsoldfood = Order::select('product_id', \DB::raw('SUM(qty) as total_sold'))
                                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                                ->groupBy('product_id')
                                ->orderByDesc('total_sold')
                                ->with('product')
                                ->first();
        $totaluser         = User::count();

        // --- Prepare annual sales data ---
        $years = range($currentYear - 3, $currentYear + 1); // e.g., 2022–2026
        $yearlySales = [];

        foreach ($years as $year) {
            $salesByMonth = array_fill(1, 12, 0); // default = 0 for all months

            $sales = Sumorder::selectRaw('MONTH(created_at) as month, SUM(grand_total) as total')
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray();

            foreach ($sales as $month => $total) {
                $salesByMonth[$month] = $total;
            }

            // store as array (0-index for ChartJS)
            $yearlySales[$year] = array_values($salesByMonth);
        }

        return view('admin.dashboard.index', compact(
            'totalproduct', 
            'totaltransaction', 
            'totalcustomer', 
            'totalsales', 
            'totalsupplier',
            'totallowstock',
            'yearlySales',
            'currentYear',
            'totalmostsoldfood',
            'totaluser'
        ));
    }
}
