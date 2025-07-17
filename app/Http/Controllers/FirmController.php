<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Models\Transaction;
use Illuminate\Http\Request;

class FirmController extends Controller
{
    // Tüm firmaları listele
    public function index()
    {
        $firms = Firm::whereNull('firm_id')->get();

        return view('firms.index', compact('firms'));
    }

    public function create($firm = null)
    {

        return view('firms.create', compact('firm'));
    }

    // Yeni firma oluştur
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firm_id' => 'nullable',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|numeric',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ]);

        $firms = Firm::create($validated);

        if ($firms) {

            if ($firms->firm_id) {
                return redirect()->route('firmalar.show', $firms->firm_id)->with('success', 'Firma başarıyla eklendi!');
            }

            return redirect()->route('firmalar.index')->with('success', 'Firma başarıyla eklendi!');
        }
        else{
            return redirect()->route('firmalar.index')->with("error","Firma eklenemedi!");
        }
    }



    // Belirli bir firmayı göster
    public function show($id)
    {

        $firms = Firm::with('transactions')->find($id);
        $deneme = Firm::where('firm_id', '=' , $firms->id)->get();





//        BUNLARI KENDİN YAZ

        $breadcrumbFirms = [];
        $current = $firms;

        while ($current) {
            $breadcrumbFirms[] = $current;
            $current = $current->parent; // bir üstüne çık
        }

        $breadcrumbFirms = array_reverse($breadcrumbFirms); // sıralamayı düzelt

//        BURAYA KADAR






        $type = request('type');
        $dateFilter = request('date');

        $transactions = $firms->transactions();

        if ($type) {
            $transactions->where('type', $type);
        }

        if ($dateFilter == 'today') {
            $transactions->whereDate('created_at', now()->toDateString());
        } elseif ($dateFilter == 'this_month') {
            $transactions->whereMonth('created_at', now()->month);
        }

        $transactions = $transactions->latest()->get();

        return view('firms.show', compact(
            'firms', 'transactions'
           ,'deneme','breadcrumbFirms'
        ));
    }


    public function edit($id){
        $firm = Firm::find($id);
        return view('firms.update', compact('firm'));
    }

    // Firma güncelle
    public function update(Request $request, $id)
    {
        $firm = Firm::find($id);

        $validated = $request->validate([
           "name" => "required|string|max:255",
           "phone" => "nullable|numeric",
           "email" => "nullable|email",
           "address" => "nullable|string",
        ]);
        $firm->update($validated);
        return redirect()->route('firmalar.index')->with('success', 'Firma başarıyla güncellendi!');
    }

    // Firma sil
    public function destroy($id)
    {
        $firm = Firm::find($id);


        if ($firm) {
            $firm->delete();
            return back()->with("success","Firma başarıyla silindi!");
        }
        else{
            return back()->with("error","Firma silinemedi!");
        }
    }

    public function transaction(Request $request, $id)
    {
        $request->validate([
            'transaction_type' => 'required|in:borc,alacak,tahsilat,odeme',
            'description' => 'required|string|max:255',
            'tutar' => 'required|numeric|min:0.01'
        ]);

        $firm = Firm::find($id);
        $tutar = $request->tutar;

        Transaction::create([
            'firm_id' => $firm->id,
            'type' => $request->transaction_type,
            'description' => $request->description,
            'amount' => $tutar
        ]);

//        switch ($request->transaction_type) {
//            case 'borc':      $firm->borc += $tutar; break;
//            case 'alacak':    $firm->alacak += $tutar; break;
//            case 'tahsilat':  $firm->alacak -= $tutar; break;
//            case 'odeme':     $firm->borc -= $tutar; break;
//        }

//        $firm->save();

        return redirect()->route('firmalar.show', $firm->id)->with('success', 'İşlem başarıyla kaydedildi.');

    }



}

