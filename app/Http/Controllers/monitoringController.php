<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\statusOrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class monitoringController extends Controller
{
    public function view(){
        $orderDetail = DetailTransaction::with('trInfo','trInfo.customer','items','status_order_item')
        ->orderByDesc('transaction_id')
        ->orderByDesc('id')
        ->paginate(20);
        $statusOrderItem = statusOrderItem::all();
        return view('monitoring.view',compact(['orderDetail','statusOrderItem']));
    }

    public function updateDetail(Request $request){
        $getItem = DetailTransaction::find($request->value_id);
        if($getItem == null){
            return redirect()->back()
            ->with('error',' Pesanan tidak ditemukan!');
        }
        $getItem['status_order_item_id'] = $request->status_order_item_id;
        $getItem->save();

        // Update status
        $transaction = Transaction::findOrFail($getItem->transaction_id);
        $transaction->status_transaction = setWorkflow($getItem->transaction_id);
        $transaction->save();


        $message = " - Pakaian berhasil di update!";
            return Redirect::route('monitoring.view')
            ->with('success',$message);
    }
}
