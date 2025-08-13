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

        $getStatusOrderItem = statusOrderItem::find(setWorkflow($getItem->transaction_id));
        $auditTrailText = '
        <p>Pakaian    : ' . $getItem->items->name . ' </p>
        <p>Catatan    : ' . $getItem->note . ' </p>
        <p>Status     : ' . $getStatusOrderItem->name . ' </p>
        <p>Keterangan : ' . $request->note . ' </p>
        ';
        createAuditTrail('transaction',$getItem->transaction_id,$auditTrailText);

        $message = " - Pakaian berhasil di update!";
            return back()->with('success', $message);
;
    }

    public function monitoringView(Request $request)
    {
        $query = $request->input('search');
        $orderDetail = DetailTransaction::with('trInfo.customer', 'items', 'status_order_item','trInfo')
        ->when($request->search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('trInfo.customer', function ($sub) use ($search) {
                    $sub->where(function ($inner) use ($search) {
                        $inner->where('customer_name', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    });
                });
                // OR filter by order_id from trInfo
                $q->orWhereHas('trInfo', function ($sub) use ($search) {
                    $sub->where('order_id', 'like', "%{$search}%");
                });
            });
        })
        ->orderByDesc('transaction_id')
        ->orderByDesc('id')
        ->paginate(20);
        $statusOrderItem = statusOrderItem::all();

        // If AJAX request, return partial view
        if ($request->ajax()) {
            return view('monitoring.partials.table', compact('orderDetail'))->render();
        }
        return view('monitoring.view', compact(['orderDetail','statusOrderItem']));
    }

    public function monitoringDetail($id){
        $getTrx = Transaction::find($id);
        $orderDetail = DetailTransaction::with('trInfo.customer','items','status_order_item')
        ->where('transaction_id','=',$id)
        ->orderByDesc('transaction_id')
        ->orderBy('item_id')
        ->orderByDesc('id')
        ->paginate(10);
        $statusOrderItem = statusOrderItem::all();
        $AuditTrails = getAuditTrails(1,$id);
        return view('monitoring.detail',compact(['getTrx','orderDetail','statusOrderItem','AuditTrails']));
    }
}
