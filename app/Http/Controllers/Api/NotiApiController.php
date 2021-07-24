<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Employee;
use Illuminate\Http\Request;
use Validator;

class NotiApiController extends Controller
{

    public function token_create(Request $request)
    {
    	$input = $request->all();
	     $rules=[
	        'emp_id'=>'required',
	        'noti_token'=>'required',
	    ];
	    $validator = Validator::make($input, $rules);

	     if ($validator->fails()) {
	        $messages = $validator->messages();
	           return response()->json(['message'=>"Error",'status'=>0]);
	    }else{
	    	$employee = Employee::find($request->emp_id);
	    	
	    	$employee = $employee->update([
	    		'noti_token'=>$request->noti_token
	    	]);
	    	return response(['message'=>"Success",'status'=>1]);
	    }
    }
}