<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view()
    {
        $customer = Customer::withCount('Transaction')->orderByDesc('customer_name')->get();
        return view('customer.view',compact(['customer']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $data = Customer::find($id);
        if ($data == null){
            $data = New Customer();
        }
        return view('customer.detail',['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
        'customer_name' => ['required', 'string', 'max:255'],
        'phone' => [
            'required',
            'string',
            'max:15',
            Rule::unique('customer','phone')->ignore($request->id),
            'regex:/^08[0-9]{8,11}$/',
        ],
        'address' => ['string', 'max:255'],
        'gender' => ['required','string','in:male,female'],
        ]);

        if ($validator->fails()) {
            $message = " - ";
                return redirect()->back()
                         ->withErrors($validator)
                         ->withInput()
                         ->with('error',' Gagal menyimpan data!');
        }
        $message = "Data has been created!";
        $validated = $validator->validated();

        $customer = Customer::create($validated);
        return Redirect::route('customer.view')
        ->with('success',$message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $getCustomer = Customer::find($request['id']);
        if ($getCustomer === null){
            $message = "Data not found!";
            // Response
            return response()->json([
                'message' => $message,
            ], 201);
        }

            $validator = Validator::make($request->all(),[
                'id' => ['required', 'integer'],
                'customer_name' => ['required', 'string', 'max:255'],
                'phone' => [
                    'required',
                    'string',
                    'max:15',
                    Rule::unique('customer','phone')->ignore($request->id),
                    'regex:/^08[0-9]{8,11}$/',
                ],
                'address' => ['string', 'max:255'],
                'gender' => ['required','string','in:male,female'],
            ]);

            if ($validator->fails()) {
                $message = "Gagal mengupdate data!";
                return redirect()->back()
                         ->withErrors($validator)
                         ->withInput()
                         ->with('warning',$message);
            }

            $validated = $validator->validated();
            $getCustomer['customer_name'] = $validated['customer_name'];
            $getCustomer['phone'] = $validated['phone'];
            $getCustomer['address'] = $validated['address'];
            $getCustomer['gender'] = $validated['gender'];

            $getCustomer->save();
            $message = " - Pelanggan berhasil di update!";
            return Redirect::route('customer.view')
            ->with('success',$message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return Redirect::route('customer.view')
        ->with('success',"Pelanggan berhasil di hapus!");
    }

    public function searchByPhone(Request $request){
        $query = $request->input('phone');
        $customers = Customer::where('phone','like',"%{$query}%")->limit(10)->get(['id','customer_name','phone']);
        return response()->json($customers);
    }
}
