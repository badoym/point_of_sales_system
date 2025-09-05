<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sumorder;
use App\Models\Order;

class SalesReportController extends Controller
{
    public function index(Request $request){
        
        $query = Sumorder::orderBy('created_at', 'asc');

        // Default date range = today
        $dateFrom = $request->datefrom ?? now()->toDateString();
        $dateTo   = $request->dateto   ?? now()->toDateString();

        $query->whereBetween(\DB::raw('DATE(created_at)'), [$dateFrom, $dateTo]);

        $totalsales = $query->get()->map(function ($sale) {
            $sale->change   = $sale->cash - $sale->grand_total;     
            $sale->vat      = $sale->grand_total * 0.12;            
            $sale->subtotal = $sale->grand_total - $sale->vat;      
            return $sale;
        });

        $totalGrand = $totalsales->sum('grand_total');
        $totalTax   = $totalsales->sum('vat');      
        $totalSub   = $totalsales->sum('subtotal');

        return view('admin.report.index', [
            'totalsales' => $totalsales,
            'totalGrand' => $totalGrand,
            'totalTax'   => $totalTax,
            'totalSub'   => $totalSub,
            'dateFrom'   => $dateFrom,
            'dateTo'     => $dateTo,
        ]);
    }


    public function view($order_number){
        
        $orders = Order::where('order_number', $order_number)
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select('orders.*', 'products.productname as product_name', 'products.saleprice', 'orders.qty')
            ->get();
        
        
            // Compute per row sales
            foreach ($orders as $order) {
                $order->saless = $order->saleprice * $order->qty;
            }

            // Compute total sales
            $totalsales = $orders->sum('saless');
        

        return view('admin.report.view', [
            'orders' => $orders,
            'totalsales' => $totalsales
        ]);
    }
}
