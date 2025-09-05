<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sumorder;
use App\Models\Order;

class CashierController extends Controller
{
    public function index(){

        $totalproduct = Product::all();
        
        return view('cashier.checkout.index', compact('totalproduct'));
    }

    public function store(Request $request){

        $user_id = auth()->id();
        $order_number = mt_rand(1000000000, 9999999999);

        foreach ($request->items as $item) {
            // Save to orders table
            \DB::table('orders')->insert([
                'user_id'      => $user_id,
                'order_number' => $order_number,
                'product_id'   => $item['product_id'],
                'price'        => $item['price'],
                'qty'          => $item['qty'],
                'total'        => $item['total'],
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            // Update product qty (deduct)
            \DB::table('products')
                ->where('id', $item['product_id'])
                ->decrement('stock', $item['qty']);
        }

        $grandTotal = $request->grand_total;
        $data = $request->validate([
            'grand_total' => 'required|string',
            'cash'        => 'required|string',
        ]);

        // Save to sumorders table
        \DB::table('sumorders')->insert([
            'user_id'      => $user_id,
            'order_number' => $order_number,
            'grand_total'  => $grandTotal,
            'cash'         => $data['cash'],
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        session()->forget('cart');

        return redirect()->back()->with('success', 'Order saved successfully!');
    }

    public function sales(){
        
        $user_id = auth()->id();

        $totalsales = Sumorder::where('user_id', $user_id)
        ->whereDate('sumorders.created_at', now())
        ->get()
        ->map(function($sale){    
            $sale->change = $sale->cash - $sale->grand_total;      // calculate change
            $sale->vat = $sale->grand_total * 0.12;               // calculate 12% VAT
            $sale->subtotal = $sale->grand_total - $sale->vat;     // calculate subtotal by grand_total - VAT(12%)

            return $sale;
        });

        $totalGrand = $totalsales->sum('grand_total');
        $totalTax   = $totalsales->sum('vat');      // total of all computed VAT
        $totalSub   = $totalsales->sum('subtotal'); // optional: total of all subtotal

        return view('cashier.sales.index', [
            'totalsales' => $totalsales,
            'totalGrand' => $totalGrand,
            'totalTax' => $totalTax,
            'totalSub' => $totalSub,
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
        

        return view('cashier.sales.view', [
            'orders' => $orders,
            'totalsales' => $totalsales
        ]);
    }
}
