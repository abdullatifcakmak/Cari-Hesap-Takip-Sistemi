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
        $stocks = Stock::where('user_id', auth()->id())->get();



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
        $validated = $request->validate([
            'product_code' => 'required|string|max:255|unique:stocks',
            'name' => 'required|string|max:255',
            'supplier_name' => 'required|nullable|numeric',
            'stock' => 'required|email',
            'purchase_price' => 'required|string',
            'sale_price' => 'required',
            'user_id' => auth()->id(),
        ]);


        $stock = Stock::create($validated);

        if ($stock) {
            return redirect()->back()->with('success', 'Stok başarıyla eklendi.');
        }
        else{
            return redirect()->back()->with('error', 'Stok eklenemedi.');
        }
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
