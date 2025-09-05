<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MealType;

class MealTypeController extends Controller
{
    public function index(){

        $mealtypes = MealType::orderBy('mealtype', 'asc')->get();

        return view('admin.mealtype.index', compact('mealtypes'));
    }

    public function create(){

        return view('admin.mealtype.create');
    }

    public function store(Request $request){

        $data = $request->validate([
            'mealtype' => 'required|string',
            'description' => 'required|string',
        ]);

        $data['status'] = 1;

        MealType::create($data);

        return redirect(route('admin.mealtype.index'))->with('success', 'Meal Type Added Successfully');
    }

    public function edit(MealType $mealtype){

        return view('admin.mealtype.edit', ['MealType' => $mealtype]);
    }

    public function update(Request $request, MealType $mealtype){
        $data = $request->validate([
            'mealtype' => 'required|string',
            'description' => 'required|string',
        ]);

        $mealtype->update($data);
        
        return redirect(route('admin.mealtype.index'))->with('success', 'Meal Type Updated Successfully');
    }

    public function destroy(MealType $mealtype){

        $mealtype->delete();

        return redirect(route('admin.mealtype.index'))->with('success', 'Meal Type Deleted Successfully');
    }

    public function toggleStatus($id){

        $mealtype = MealType::findOrFail($id);

        // Toggle status: 1 => 0, 0 => 1
        $mealtype->status = $mealtype->status == 1 ? 0 : 1;
        $mealtype->save();

        return redirect()->back()->with('success', 'Meal Type status updated successfully!');
    }
}
