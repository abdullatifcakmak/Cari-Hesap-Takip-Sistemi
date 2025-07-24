<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = Stock::all();



        return view('stocks.index' , compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Stock::create($request->all());

        return redirect()->back()->with('success', 'Stok başarıyla eklendi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stock = Stock::find($id);
        return view('stocks.update', compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $stock = Stock::find($id);


        $validated = $request->validate([
            'product_code' => 'required',
            "name" => "required",
            "supplier_name" => "required",
            "stock" => "required",
            "purchase_price" => "required",
            "sale_price" => "required",


        ]);

        $stock->update($validated);
        return redirect()->route('stocks.index')->with('success', 'Başarıyla güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stock = Stock::find($id);

        if ($stock) {
            $stock->delete();
            return back()->with("success","Firma başarıyla silindi!");
        }
        else{
            return back()->with("error","Firma silinemedi!");
        }
    }




}
