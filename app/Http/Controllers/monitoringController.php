<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use Illuminate\Http\Request;

class monitoringController extends Controller
{
    public function view(){
        $orderDetail = DetailTransaction::with('trInfo','trInfo.customer','items','status_order_item')
        ->orderByDesc('id')
        ->paginate(10);
        return view('monitoring.view',compact(['orderDetail']));
    }
}
