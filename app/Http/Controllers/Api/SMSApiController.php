<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SMSGO;
use App\User;
use App\Employee;
use Session;
use Hash;

class SMSApiController extends Controller
{
    /**
    * Sending the OTP.
    *
    * @return Response
    */
    public function sendOtp(Request $request)
    {
    	$response =[];
        $user_phone = User::where('loginId',$request->phone)->orwhere('email',$request->phone)->get();
        // dd($user_phone);
        if (!$user_phone->isEmpty() && $request->phone !="" ) {
          
            // dd("Here");
            $SMSGO = new SMSGO();

            $otp = rand(100000, 999999);

            $checkuser = User::where("loginId",$request->phone)->orwhere('email',$request->phone)->get();
            // dd($checkuser[0]->role_id);
            if ($checkuser[0]->loginId == $request->phone) {
                if($checkuser->count()>0){
                    $user = User::find($checkuser[0]->id);

                    $user = $user->update([
                            'loginId'=>$request->phone,
                            'password' => Hash::make($otp)
                        ]);
                }
        
                $msgGoResponse = $SMSGO->sendSMS($otp,$request->phone);

                if($msgGoResponse->responseCode==0){
                    $response['error'] = 1;
                    $response['message'] = $msgGoResponse->responseMessage;
                    $response['result'] = null;
                }else{ 
                    $response['error'] = 0;
                    $response['message'] = $msgGoResponse->responseMessage;
                    $response['result'] = $msgGoResponse->result;
                    $response['OTP'] = $otp;
                    $response['role_id']=$checkuser[0]->role_id;
                }
                } else {
                    // dd(auth()->user());
                    $response['error'] = 0;
                    $response['message'] = "Successfully login";
                    $response['role_id'] = auth()->user() == null ? auth()->user() : auth()->user()->roles[0]->id;
                    // echo json_encode($response);
                }
                echo json_encode($response);
            }else{
                $response['error'] = 1;
                $response['message'] = 'Invalid phone number';
                echo json_encode($response);
            }
            
    }


    public function verifyOtp(Request $request)
    {
        $phoneno = $request->input('loginId');
        $enteredOtp = $request->input('password');

        $loginData = [
            'loginId' => $phoneno,
            'password' => $enteredOtp
        ];

        if (!auth()->attempt($loginData)) {
            return response([
                'message' => 'OTP incorrect!',
                'status'=>0
            ]);
        }else{
             $accessToken = auth()->user()->createToken('authToken')->accessToken;
             $employee = Employee::where('user_id',auth()->user()->id)->get();
             if (auth()->user()->roles[0]->id == 4) {
                $employee = Employee::where('user_id',auth()->user()->id)->get();
                // dd($driver[0]);
                if ($employee[0]->active == 0) {
                    return response(['message'=>"Employee is inactive",'status'=>1]);
                }else{
                    // dd($employee[0]);
                    $data =[
                        'role_id'=>auth()->user()->roles[0]->id,
                        'loginId'=>auth()->user()->loginId,
                        'password'=>auth()->user()->password,
                        'name'=>auth()->user()->name,
                        'email'=>auth()->user()->email,
                        'employeeId'=>$employee[0]->id,
                        'ename'=>$employee[0]->name,
                        'phone'=>$employee[0]->phone_no,
                     ];
                }
                
             }else{
                $data =[
                'role_id'=>auth()->user()->roles[0]->id,
                'loginId'=>auth()->user()->loginId,
                'password'=>auth()->user()->password,
                'name'=>auth()->user()->name,
                'email'=>auth()->user()->email,
                'employeeId'=>auth()->user()->id,
                'ename'=>auth()->user()->name,
                'phone'=>auth()->user()->loginId,
             ];
             }

             return response([
                    'user' =>$data,
                    'access_token' =>$accessToken,
                    'message'=>"Successfully login",
                    'status'=>1
            ]);
        } 

    }

    // public function verifyPassword(Request $request)
    // {
    //     # code...
    // }


}
