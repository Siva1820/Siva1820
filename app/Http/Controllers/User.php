<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Session; 
use DataTables; 

class User extends Controller
{
    public function validateLogin(Request $request)
    {
    	$validator = Validator::make($request->all(),[

    		'email'  	=> 'required|email',
    		'password'  => 'required',

    	]);
        Session::put('is_valid', false);
    	if($validator->fails())
    	{
    		return response()->json(['code' => 400,'message' => 'Invalid input']);
    	}
        
    	$credentials = request(['email','password']);

    	$result     = DB::select("SELECT * FROM users WHERE email = '".$request->email."' AND password = PASSWORD('".$request->password."')");
        if(count((array)$result)==0)
        {
            return response()->json(['code' => 401,'message' => 'Incorrect Email or Password']);
        }
        $token = $this->generateUniqueNo(15);
        Session::put('is_valid', true);
        Session::put('login_id', $result[0]->id);
        Session::put('username', $result[0]->name);
        Session::put('login_ip', $request->ip());
        Session::put('token', $token);

    	return response()->json(['code' => 200,'message' => 'Login successfully','token' => $token]);
    }
    public function makeLogout(Request $request)
    {   
        Session::flush();
        return response()->json(['code' => 200,'message' => 'Logout successfully']);
    }
}
