<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class InvetoryController extends Controller
{
    public function index(){

        $product   = Product::join('meal_types', 'products.category', '=', 'meal_types.id')
                        ->select('products.*', 'meal_types.mealtype as category_name')
                        ->get();

        $totalproduct   = Product::count();
        $totallowstock  = Product::where('stock', '<=', 10)
                            ->where('stock', '>=', 1)
                            ->count();
        $totaloutstock  = Product::where('stock', [0, 4])->count();
        $totalmoststock = Product::where('stock', '>=', 11)->count();

        return view('admin.invetory.index', 
                compact(
                    'product',
                    'totalproduct',
                    'totallowstock',
                    'totaloutstock',
                    'totalmoststock'
                ));
    }
}
