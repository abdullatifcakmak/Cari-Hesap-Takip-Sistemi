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

//        $total_borc = $firms->transactions()->where('type', 'borc')->sum('amount');
//        $total_odeme = $firms->transactions()->where('type', 'odeme')->sum('amount');
//        $total_alacak = $firms->transactions()->where('type', 'alacak')->sum('amount');
//        $total_tahsilat = $firms->transactions()->where('type', 'tahsilat')->sum('amount');
//
//        $net_borc = $total_borc + $total_odeme;
//        $net_alacak = -$total_alacak - $total_tahsilat;

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
}
