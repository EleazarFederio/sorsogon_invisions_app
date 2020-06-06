<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ApiEmployeeController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|numeric|min:11',
            'password' => 'required',
        ]);

        $employee = Employee::where('phone_number', $request->phone_number)->first();

        if (! $employee || ! Hash::check($request->password, $employee->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $employee->createToken('xxxx')->plainTextToken;
        return response()->json([
            'success' => true,
            'token' => $token,
            'customer' => $employee
        ]);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "full_name" => "required",
            'phone_number' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], Response::HTTP_UNAUTHORIZED);
        }
        $input = $request->all();
        $input['last_name'] = 'XXX';
        $input['password'] = Hash::make($input['password']);
        $employee = Employee::create($input);
        $token = $employee->createToken('aaa')->plainTextToken;
        return response()->json([
            'success' => true,
            'token' => $token,
            'employee' => $employee
        ]);
    }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
