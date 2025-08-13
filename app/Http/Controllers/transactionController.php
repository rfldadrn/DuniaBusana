<?php

namespace App\Http\Controllers;

use App\Models\AuditTrails;
use App\Models\Customer;
use App\Models\DetailTransaction;
use App\Models\Item;
use App\Models\statusTransaction;
use App\Models\Transaction;
use App\Models\transactionType;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\ValidationException;

function generateTransactionCode($prefix = 'TRX') {
    $now = Carbon::now();
    $date = $now->format('Ymd');       // e.g. 20250723
    $time = $now->format('His');       // e.g. 220745
    $micro = $now->format('u');        // e.g. 123456 (microseconds) - test

    return "{$prefix}-{$date}-{$time}-{$micro}";
}


class transactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view()
    {
        $transactionType = transactionType::all();
        $statusTransaction = statusTransaction::all();
        $paymentStatus = PaymentStatus::all();
        $data = Transaction::with(['customer','transaction_type','status_payment','status','creator','modifier','getAuditTrail'])
        ->orderBy('order_id','desc')
        ->paginate(10);
        return view('transaction.view',compact(['data','transactionType','statusTransaction','paymentStatus']));
    }

    public function viewWithFilter(Request $request){
        $transactionType = transactionType::all();
        $statusTransaction = statusTransaction::all();
        $paymentStatus = PaymentStatus::all();
        $query = Transaction::with(['customer','transaction_type','status_payment','status','creator','modifier']);

        // Check each field for filter
        if ($request->filled('order_id')) {
            $query->where('order_id', $request->order_id);
        }
        if ($request->filled('customer')) {
            $query->whereHas('customer', function ($q) use ($request) {
                $q->where('customer_name','like' , '%' . $request->customer . '%');
            });
        }
        if ($request->filled('transaction_type_id')) {
            $query->where('transaction_type_id', $request->transaction_type_id);
        }
        if ($request->filled('payment_status_id')) {
            $query->where('payment_status_id', $request->payment_status_id);
        }
        if ($request->filled('status_transaction')) {
            $query->where('status_transaction', $request->status_transaction);
        }
        if ($request->filled('transaction_date')) {
            $query->whereDate('transaction_date', $request->transaction_date);
        }
        if ($request->filled('completion_date')) {
            $query->whereDate('completion_date', $request->completion_date);
        }

        $data = $query->orderBy('order_id', 'desc')->paginate(10);
        return view('transaction.view',compact([
            'data',
            'transactionType',
            'statusTransaction',
            'paymentStatus'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trxID = generateTransactionCode();
        $transactionType = transactionType::all();
        $statusTransaction = statusTransaction::all();
        $itemType = Item::all();
        $customer = Customer::select('id','customer_name')->get();
        $action = "create";
        return view('transaction.detail',compact(['customer','transactionType','trxID','statusTransaction','itemType','action']));
    }

    public function downloadInvoice($id){
        $getTrx = Transaction::with(['customer','transaction_type','status_payment','status','creator','modifier'])->find($id);
        $detail_order = DetailTransaction::with('items')->where('transaction_id',$id)->get();
        $pdf = Pdf::loadView('pdf.invoice', compact(['getTrx','detail_order']));
        // return $pdf->download('invoice-'.$transaction->id.'.pdf');
        return $pdf->stream('invoice-'.$getTrx->id.'.pdf');
        // return view('transaction.struck',compact(['getTrx','detail_order']));
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        // Replace price
        $request['amount'] = preg_replace('/\D/', '',$request->amount);
        $request['paid_amount'] = preg_replace('/\D/', '',$request->paid_amount);

        // Validator
        $validator = Validator::make($request->all(),[
            'order_id' => ['required', 'string', 'max:255',Rule::unique('transaction','order_id')],
            'transaction_type_id' => ['required', 'integer',Rule::exists('transaction_type', 'id')],
            'customer_id' => ['required', 'integer',Rule::exists('customer', 'id')],
            'transaction_date' => ['date','required','before_or_equal:today'],
            'completion_date' => ['date','required','after_or_equal:today'],
            'amount' => ['required','numeric','min:0'],
            'paid_amount' => ['nullable','numeric','min:0'],
            'status_transaction' => ['required','numeric',Rule::exists('status_transaction','id')],
            'notes' => ['required','string','max:1000']
        ]);

        if($request->paid_amount != ""){
            $validator->after(function ($validator) use ($request){
                if($request->paid_amount > $request->amount){
                    $validator->errors()->add('paid_amount','Paid amount must not exceed the total amount.');
                }
            });
        }


        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error',' Transaksi gagal!');
        }

        if($request->list_order == ""){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error',' Detail pesanan belum ada!');
        }


        // Save Transaction Header
        $message = "Data has been created!";
        $validated = $validator->validated();
        // Validation Payment Status
        if($request->paid_amount == "" || $request->paid_amount == 0){
            $validated['payment_status_id'] = 1;
            $validated['paid_amount'] = 0;
        }else if($request->paid_amount < $request->amount){
            $validated['payment_status_id'] = 2;
        }else{
            $validated['payment_status_id'] = 3;
        }
        $validated['balance_due'] = $validated['amount'] - $validated['paid_amount'];
        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();
        $transaction = Transaction::create($validated);

        // Save Transaction Detail
        $detail_order = json_decode($request->list_order);

        foreach ($detail_order as $do) {
            DetailTransaction::create([
                'transaction_id' => $transaction->id,
                'item_id' => $do->item_id,
                'qty' => $do->qty,
                'price' => $do->price,
                'note' => $do->item_note,
                'status_order_item_id' => 1,
            ]);
        }

        $getTrType = transactionType::find($transaction->transaction_type_id);
        $getCustomer = Customer::find($transaction->customer_id);
        $auditTrailText = '
        <p>Nomor Transaksi : ' . $validated['order_id'] . ' </p>
        <p>Nama Pelannggan : ' . $getCustomer['customer_name'] . ' </p>
        <p>Tipe Transaksi : ' . $getTrType['name'] . ' </p>
        <p>Total Transaksi : Rp. ' . number_format($validated['amount'], 0, ',', '.') . ' </p>
        <p>Uang Muka : Rp. ' . number_format($validated['paid_amount'], 0, ',', '.') . ' </p>
        ';
        createAuditTrail('transaction',$transaction->id,$auditTrailText);

        return Redirect::route('transaction.edit',['id' => $transaction['id']])
        ->with('success',$message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Under construct
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $getTrx = Transaction::with(['customer','transaction_type','status_payment','status','creator','modifier'])->find($id);
        $AuditTrails = getAuditTrails(1,$id);
        $transactionType = transactionType::all();
        $statusTransaction = statusTransaction::all();
        $statusPayment = PaymentStatus::all();
        $itemType = Item::all();
        $customer = Customer::select('id','customer_name')->get();
        $action = "detail";
        $detail_order = DetailTransaction::with('items','status_order_item')->where('transaction_id',$id)->get()->toJson();
        return view('transaction.detail',compact(['action','customer','transactionType','getTrx','statusTransaction','itemType','detail_order','statusPayment','AuditTrails']));
    }

    public function pickUpTransaction(Request $request)
    {
        // Update transaction
        $transaction = Transaction::find($request->transaction_id);
        $transaction['status_transaction'] = 4; // Sudah diambil
        $transaction->save();

        // Update detail
        DetailTransaction::where('transaction_id', '=', $request->transaction_id)
            ->update(['status_order_item_id' => 7]);

        return response()->json([
            'redirect_url' => route('transaction.edit', ['id' => $transaction->id]),
            'message' => 'Pesanan berhasil di ambil!'
        ]);


        // // Return JSON response
        // return response()->json([
        //         'message' => 'Transaksi selesai!',
        //         'transaction_id' => $transaction->id,
        //         'status_transaction' => $transaction->status_transaction
        //     ]);

        // return response()->json([
        //     'message' => 'Transaksi selesai!',
        //     'transaction_id' => $transaction,
        // ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $transaction = Transaction::find($request->id);

        // Replace price
        $request['amount'] = preg_replace('/\D/', '',$request->amount);
        $request['paid_amount'] = preg_replace('/\D/', '',$request->paid_amount);

        // Validator
        $validator = Validator::make($request->all(),[
            'transaction_type_id' => ['required', 'integer',Rule::exists('transaction_type', 'id')],
            'customer_id' => ['required', 'integer',Rule::exists('customer', 'id')],
            'transaction_date' => ['date','required','before_or_equal:completion_date'],
            'completion_date' => ['date','required','after_or_equal:transaction_date'],
            'amount' => ['required','numeric','min:0'],
            'paid_amount' => ['nullable','numeric','min:0'],
            'status_transaction' => ['required','numeric',Rule::exists('status_transaction','id')],
            'notes' => ['nullable','string','max:1000']
        ]);

        if($request->paid_amount != ""){
            $validator->after(function ($validator) use ($request){
                if($request->paid_amount > $request->amount){
                    $validator->errors()->add('paid_amount','Paid amount must not exceed the total amount.');
                }
            });
        }


        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error',' Transaksi gagal!');
        }

        if($request->list_order == ""){
            return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error',' Detail pesanan belum ada!');
        }


        // Save Transaction Header
        $message = "Data has been updated!";
        $validated = $validator->validated();


        // Validation Payment Status
        if($request->paid_amount == "" || $request->paid_amount == 0){
            $transaction['payment_status_id'] = 1;
            $transaction['paid_amount'] = 0;
        }else if($request->paid_amount < $request->amount){
            $transaction['payment_status_id'] = 2;
            $transaction['paid_amount'] = $request->paid_amount;
        }else{
            $transaction['payment_status_id'] = 3;
            $transaction['paid_amount'] = $request->paid_amount;
        }
        $transaction['id']                      = $request->id;
        $transaction['transaction_type_id']     = $validated['transaction_type_id'];
        $transaction['customer_id']             = $validated['customer_id'];
        $transaction['transaction_date']        = $validated['transaction_date'];
        $transaction['completion_date']         = $validated['completion_date'];
        $transaction['amount']                  = $validated['amount'];
        $transaction['balance_due']             = $validated['amount'] - $validated['paid_amount'];
        $transaction['status_transaction']      = $validated['status_transaction'];
        $transaction['notes']                   = $validated['notes'];
        $transaction['updated_by']              = Auth::id();


        $transaction->save();
        // Save Transaction Detail
        $detail_order = json_decode($request->list_order);

        // Delete Detail
        DetailTransaction::where('transaction_id',$request->id)->delete();
        // Add Detail
        foreach ($detail_order as $do) {
            DetailTransaction::create([
                'transaction_id' => $request->id,
                'item_id' => $do->item_id,
                'qty' => $do->qty,
                'price' => $do->price,
                'note' => $do->item_note,
                'status_order_item_id' => $do->status_id,
            ]);
        }

        return Redirect::route('transaction.edit',['id' => $transaction['id']])
        ->with('success',$message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction != "") {
            DetailTransaction::where('transaction_id',$id)->delete();
            $transaction->delete();
            return Redirect::route('transaction.view')
            ->with('success',"Data has been deleted");
        }else{
            return Redirect::route('transaction.view')
            ->with('error',"Data not found!");
        }
    }
}
