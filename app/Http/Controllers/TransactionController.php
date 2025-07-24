<?php

namespace App\Http\Controllers;

use App\Models\Firm;
use App\Models\Transaction;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    public function create(Request $request)
    {
        $firma_id = $request->input('firma_id');
        return view('transactions.create', compact('firma_id'));
    }

    public function store(Request $request, $id)
    {

        $validated = $request->validate([
            'type' => 'required|in:borc,alacak,odeme,tahsilat',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $validated['firm_id'] = $id;

        Transaction::create($validated);

        $firms = Firm::find($id);

        if ($request->type == "borc" || $request->type == "odeme") {

            $firms->debt += $request->amount;
            $firms->balance += $request->amount;

        }
        else{
            $firms->credit -= $request->amount;
            $firms->balance -= $request->amount;
        }

        $firms->update();



        return back()->with('success', 'Borç/Alacak başarıyla eklendi');
    }

    public function destroy($id){

        $islem = Transaction::find($id);
        $firms = Firm::find($islem->firm_id);

        if ($islem) {


            if ($islem->type == "borc" || $islem->type == "odeme") {

                $firms->debt -= $islem->amount;
                $firms->balance -= $islem->amount;

            }
            else{
                $firms->credit += $islem->amount;
                $firms->balance += $islem->amount;
            }

            $firms->update();
            $islem->delete();

            return back()->with('success', 'İşlem başarıyla silindi');

        }
        else{
            return back()->with('error' , 'İşlem silinemedi');
        }

    }

    public function edit($id){
        $transaction = Transaction::find($id);
        $firm = Transaction::find($transaction->id)->firm;
        return view('firms.updateTransaction', compact('transaction','firm'));
    }

    public function update(Request $request, $id){
        $transaction = Transaction::find($id);
        $firms = Firm::find($transaction->firm_id);
        $validated = $request->validate([
            'type' => 'required|in:borc,alacak,tahsilat,odeme',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01'
        ]);
        $transaction->update($validated);

        if ($transaction) {

            if ($transaction->type == "borc" || $transaction->type == "odeme") {

                $firms->debt += $transaction->amount;
                $firms->balance += $transaction->amount;

            } else {
                $firms->credit -= $transaction->amount;
                $firms->balance -= $transaction->amount;
            }


        }

        $firms->update();


        return redirect()->route('firmalar.show',$firms->id)->with('success', 'İşlem başarıyla güncellendi');

    }



}
