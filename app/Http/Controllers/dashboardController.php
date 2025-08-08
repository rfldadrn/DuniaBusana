<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function view(){
        $User = User::all();
        $Customer = [
            'data' => Customer::withCount('Transaction')
            ->withSum('Transaction','amount')
            ->orderByDesc('transaction_sum_amount')
            ->orderByDesc('transaction_count')
            ->limit(5)
            ->get(),
            'count' => Customer::all()->count(),
        ];
        $currentDate = Carbon::now()->format('Y-m-d');
        $retention = env('MAX_DAY_RETENTION');
        $MaxDate = Carbon::now()->addDays((int) $retention)->format('Y-m-d');
        $Transaction = [
            'data' => Transaction::with('status','customer')
            ->orderBy('order_id','DESC')
            ->limit(5)
            ->get(),
            'count' => Transaction::all()->count(),
            'pendingOrder' => Transaction::whereDate('completion_date','<=',$MaxDate)
            ->whereIn('status_transaction',[1,2,6])
            ->orderBy('completion_date','asc')
            ->get()
        ];

        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $Revenue = [
            'total' => Transaction::whereBetween('transaction_date',[$currentMonthStart, $currentMonthEnd])->sum('paid_amount'), //Sementara
        ];
        return view('dashboard',compact(['User','Customer','Transaction','Revenue']));
    }
}
