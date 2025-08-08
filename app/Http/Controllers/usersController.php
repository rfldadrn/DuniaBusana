<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class usersController extends Controller
{
    public function view(){
        $data = User::with('role')->get();
        return view('users.view',['data' => $data]);
    }

    public function detail($id){
        $data = User::find($id);
        $role = Role::all();
        // For Create
        if ($data == null) {
            $data = new User();
        }
        return view('users.detail',['data' => $data,'role'=>$role]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required', 'string', 'email', 'max:255', 'lowercase',
            Rule::unique('users'),
        ],
        // 'password' => ['required', Password::defaults(), 'confirmed'],
        'roleId' => ['required', 'integer',Rule::exists('role', 'id')], //  corrected table name
        ]);
        
        if ($validator->fails()) {
            $message = " - ";
                return redirect()->back()
                         ->withErrors($validator)
                         ->withInput()
                         ->with('error',' Gagal menyimpan data!');
            // return response()->json([
            //     'message' => 'Validation failed',
            //     'errors' => $validator->errors()
            // ], 422);
        }
        $message = "Data has been created!";
        $TempPassword = env('PASSWORD_TEMP');
        $validated = $validator->validated();
        $validated['password'] = Hash::make($TempPassword);
        $validated['isActive'] = true;

        $user = User::create($validated);
        return Redirect::route('users.view')
        ->with('success',$message);
        // return response()->json([
        //     'message' => 'User created successfully',
        //     'data' => $user->load('role') //  return full user with role relationship
        // ], 201);
    }

    public function update(Request $request){
        $getUser = User::find($request['id']);
        if ($getUser === null){
            $message = "Data not found!";
            // Response
            return response()->json([
                'message' => $message,
            ], 201);
        }
            
            $validator = Validator::make($request->all(),[
                'id' => ['required', 'integer'],
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required', 'string', 'email', 'max:255', 'lowercase',
                    Rule::unique('users')->ignore($request->id),
                ],
                'roleId' => ['required', 'integer',Rule::exists('role', 'id')], //  corrected table name
            ]);
            
            if ($validator->fails()) {
                $message = "Gagal mengupdate data!";
                return redirect()->back()
                         ->withErrors($validator)
                         ->withInput()
                         ->with('warning',$message);
                // JSON
                // return response()->json([
                //     'message' => 'Validation failed',
                //     'errors' => $validator->errors()
                // ], 422);
            }

            $validated = $validator->validated();
            
            $getUser['name'] = $validated['name'];
            $getUser['email'] = $validated['email'];
            $getUser['roleId'] = $validated['roleId'];
            
            $getUser->save();
            $message = "Successfully - User has been updated!";
        // return response()->json([
        //     'message' => $message,
        //     'data' => $validated,
        // ], 201);
        
        return Redirect::route('users.view')
        ->with('success',$message);
    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return Redirect::route('users.view')
        ->with('success',"Data has been deleted");
    }
}
