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
            'supplier_name' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
        ], [
            'product_code.required' => 'Ürün kodu alanı zorunludur.',
            'product_code.string' => 'Ürün kodu metin olmalıdır.',
            'product_code.max' => 'Ürün kodu en fazla 255 karakter olabilir.',
            'product_code.unique' => 'Bu ürün kodu zaten kayıtlı.',

            'name.required' => 'Ürün adı zorunludur.',
            'name.string' => 'Ürün adı metin olmalıdır.',
            'name.max' => 'Ürün adı en fazla 255 karakter olabilir.',

            'supplier_name.numeric' => 'Tedarikçi bilgisi sadece sayı olabilir.',

            'stock.required' => 'Stok miktarı zorunludur.',
            'stock.integer' => 'Stok miktarı tam sayı olmalıdır.',
            'stock.min' => 'Stok miktarı en az 0 olabilir.',

            'purchase_price.required' => 'Alış fiyatı zorunludur.',
            'purchase_price.numeric' => 'Alış fiyatı sayı olmalıdır.',
            'purchase_price.min' => 'Alış fiyatı negatif olamaz.',

            'sale_price.required' => 'Satış fiyatı zorunludur.',
            'sale_price.numeric' => 'Satış fiyatı sayı olmalıdır.',
            'sale_price.min' => 'Satış fiyatı negatif olamaz.',
        ]);


        $validated = array_merge($validated, ['user_id' => auth()->id()]);


        $stock = Stock::create($validated);

        return 1;

        dd($stock);
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
