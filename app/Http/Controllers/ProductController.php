<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\MealType;

class ProductController extends Controller
{
    public function index(){

        $products = Product::join('meal_types', 'products.category', '=', 'meal_types.id')
                   ->select('products.*', 'meal_types.mealtype as meal')
                   ->orderBy('productname', 'asc')
                   ->get();

        return view('admin.product.index', compact('products'));
    }

    public function create(){

        $mealtype = MealType::all()
        ->where('status', 1);

        return view('admin.product.create', compact('mealtype'));
    }

    public function store(Request $request){
        $data = $request->validate([
            'productname' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
            'saleprice' => 'required|string',
            'stock' => 'required|string',
            'unit' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data['status'] = 1;

        // Save the uploaded image
        if($request->hasFile('image')){
            $filename = time().'_'.$request->image->getClientOriginalName();
            $path = $request->image->storeAs('products', $filename, 'public');
            $data['image'] = $path;
        }

        Product::create($data);

        return redirect(route('admin.product.index'))->with('success', 'Food Added Successfully');
    }

    public function edit(Product $product){
        
        return view('admin.product.edit', ['products' => $product]);
    }

    public function update(Product $product, Request $request ){
        $data = $request->validate([
            'productname' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|string',
            'saleprice' => 'required|string',
            'stock' => 'required|string',
            'unit' => 'required|string',
        ]);

        $product->update($data);

        return redirect(route('admin.product.index'))->with('success', 'Food Updated Successfully');
    }

    public function destroy(Product $product){

        $product->delete();

        return redirect(route('admin.product.index'))->with('success', 'Food Deleted Successfully');
    }

    public function toggleStatus($id){

        $product = Product::findOrFail($id);

        // Toggle status: 1 => 0, 0 => 1
        $product->status = $product->status == 1 ? 0 : 1;
        $product->save();

        return redirect()->back()->with('success', 'Product status updated successfully!');
    }
}
