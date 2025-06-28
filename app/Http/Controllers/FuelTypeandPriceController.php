<?php

namespace App\Http\Controllers;

use App\Models\FuelType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FuelTypeandPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['fuels'] = FuelType::with('user')->orderBy('id', 'desc')->get();
        return view('backend.fuel-type.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['update'] = false;
        return view('backend.fuel-type.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fuel_type_kh' => 'required|string|max:255|unique:fuel_types,fuel_type_kh',
            'fuel_type_en' => 'required|string|max:255|unique:fuel_types,fuel_type_en',
            'today_price' => 'required|numeric|max:255',
        ]);
        $visibility = '';

        if($request->has('public')) $visibility = 1;
        else $visibility = 0;

        $addPrice = FuelType::create([
            'fuel_type_kh' => $request->fuel_type_kh,
            'fuel_type_en' => $request->fuel_type_en,
            'today_price' => $request->today_price,
            'created_by' => @Auth::user()->id,
            'visibility' => $visibility,
        ]);

        if($addPrice == true) return redirect()->back()->with('success', __('Add fuel today price successful'));
        else return redirect()->back()->with('error', __('Add fuel today price failed'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['update'] = true;
        $data['fuel'] = FuelType::findOrFail($id);
        return view('backend.fuel-type.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fuel = FuelType::findOrFail($id);
        $request->validate([
            'fuel_type_kh' => 'required|string|max:255|unique:fuel_types,fuel_type_kh,' . $id,
            'fuel_type_en' => 'required|string|max:255|unique:fuel_types,fuel_type_en,' . $id,
            'today_price' => 'required|numeric|max:255',
        ]);
        $visibility = '';

        if($request->has('public')) $visibility = 1;
        else $visibility = 0;

        $addPrice = $fuel->update([
            'fuel_type_kh' => $request->fuel_type_kh,
            'fuel_type_en' => $request->fuel_type_en,
            'today_price' => $request->today_price,
            'created_by' => @Auth::user()->id,
            'updated_at' => now(),
            'visibility' => $visibility,
        ]);

        if($addPrice == true) return redirect()->route('fuel-type-price.index')->with('success', __('Edit fuel today price successful'));
        else return redirect()->back()->with('error', __('Edit fuel today price failed'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
