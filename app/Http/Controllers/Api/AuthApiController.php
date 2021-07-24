<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Employee;
use App\OfficeReporter;

use Illuminate\Http\Request;

class AuthApiController extends Controller
{

    public function adminlogin(Request $request)
    {
        
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        // dd($loginData);
        if (!auth()->attempt($loginData)) {
            return response(['message' => 'User name or password is invalid','status'=>0]);
        }else{
            // dd(auth()->user());
             $accessToken = auth()->user()->createToken('authToken')->accessToken;
             $user = auth()->user();
             $user->user_role = $user->roles[0]->name;

             $employee = Employee::where('user_id',auth()->user()->id)->get();
            
            if (count($employee)>0) {
                if ($employee[0]->active == 0) {
                    return response(['message'=>"Employee is inactive",'status'=>1]);
                }else{
                    $user->emp_id = $employee[0]->id;
                    $user->emp_photo = $employee[0]->photo;
                    $user->branch_id = $employee[0]->branch_id;
                    $user->dept_id = $employee[0]->dep_id;
                    $user->position_id = $employee[0]->position_id;
                }
            }
                
             return response(['user' => $user,'accessToken'=>$accessToken,'message'=>"Successfully login",'status'=>1]);
        } 
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'loginId' => 'required',
            'password' => 'required'
        ]);
        if (!auth()->attempt($loginData)) {
          // dd(auth()->attempt($loginData));
            return response(['message' => 'User name or password is invalid','status'=>0]);
        }else{
             $accessToken = auth()->user()->createToken('authToken')->accessToken;
             $employee = Employee::where('user_id',auth()->user()->id)->get();
             // dd($employee);
             if (auth()->user()->roles[0]->id == 4) {
                $employee = Employee::where('user_id',auth()->user()->id)->get();
                // dd($driver[0]);
                if ($employee[0]->active == 0) {
                    return response(['message'=>"Employee is inactive",'status'=>1]);
                }else{
                    $data =[
                        'role_id'=>auth()->user()->roles[0]->id,
                        'loginId'=>auth()->user()->loginId,
                        'password'=>auth()->user()->password,
                        'name'=>auth()->user()->name,
                        'email'=>auth()->user()->email,
                        'employeeId'=>$employee[0]->id,
                        'branch_id'=>$employee[0]->branch_id,
                        'dept_id'=>$employee[0]->dep_id,
                        'position_id'=>$employee[0]->position_id,
                        'photo'=>$employee[0]->photo,
                        'ename'=>$employee[0]->name,
                        'phone'=>$employee[0]->phone_no,
                        'user_role'=>auth()->user()->roles[0]->name
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
                'user_role'=>auth()->user()->roles[0]->name
             ];
             }

             // dd($data['employeeId']);
             $ro = OfficeReporter::where('ro_id',$data['employeeId'])->get();
             // dd($ro);
             if (count($ro)>0) {
                 return response(['data' => $data, 'access_token' => $accessToken,'message'=>"Successfully login",'status'=>1,'ro_status'=>1]);
             }else{
                return response(['data' => $data, 'access_token' => $accessToken,'message'=>"Successfully login",'status'=>1,'ro_status'=>0]);
             }
             
             // return response(['data' => $data, 'access_token' => $accessToken,'message'=>"Successfully login",'status'=>1]);
        } 

    }
} 