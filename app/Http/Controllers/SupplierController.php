<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index(){

        $suppliers = Supplier::orderBy('suppliername', 'asc')->get();

        return view('admin.supplier.index', compact('suppliers'));
    }

    public function create(){
        
        return view('admin.supplier.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'suppliername' => 'required|string',
            'contactno' => 'required|string',
            'emailaddress' => 'required|string',
            'address' => 'required|string',
        ]);

        $data['status'] = 1;

        Supplier::create($data);

        return redirect(route('admin.supplier.index'))->with('success', 'Supplier Added Successfully');
    }

    public function edit(Supplier $supplier){

        return view('admin.supplier.edit', ['suppliers' => $supplier]);
    }

    public function update(Request $request, Supplier $supplier){
        $data = $request->validate([
            'suppliername' => 'required|string',
            'contactno' => 'required|string',
            'emailaddress' => 'required|string',
            'address' => 'required|string',
        ]);

        $supplier->update($data);

        return redirect(route('admin.supplier.index'))->with('success', 'Supplier Updated Successfully');
    }

    public function destroy(Supplier $supplier){
        
        $supplier->delete();

        return redirect(route('admin.supplier.index'))->with('success', 'Supplier Deleted Successfully');
    }

    public function toggleStatus($id){

        $supplier = Supplier::findOrFail($id);

        // Toggle status: 1 => 0, 0 => 1
        $supplier->status = $supplier->status == 1 ? 0 : 1;
        $supplier->save();

        return redirect()->back()->with('success', 'Supplier status updated successfully!');
    }
}
