<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'Api\AuthApiController@login'); 

Route::post('/sendOtp','Api\SMSApiController@sendOtp');

Route::post('/verifyOtp','Api\SMSApiController@verifyOtp');

Route::post('/adminlogin','Api\AuthApiController@adminlogin');

// Route::get('/dashboard', 'Api\DashboardApiController@dashboard');

// Route::post('/emp_data/{id}','Api\EmployeeApiController@get_emp_data');

// Route::post('/emp_salary','Api\EmployeeApiController@get_emp_salary');

// Route::post('/department', 'Api\DepartmentApiController@department');
// Route::post('/department_create','Api\DepartmentApiController@department_create');
// Route::post('/department_edit/{id}','Api\DepartmentApiController@department_edit');
// Route::post('/department_delete/{id}','Api\DepartmentApiController@department_delete');
// Route::post('/department_activeInactive/{id}','Api\DepartmentApiController@department_activeInactive');

Route::post('/branch', 'Api\BranchApiController@branch');
// Route::post('/branch_create','Api\BranchApiController@branch_create');
// Route::post('/branch_edit/{id}','Api\BranchApiController@branch_edit');
// Route::post('/branch_delete/{id}','Api\BranchApiController@branch_delete');
// Route::post('/branch_activeInactive/{id}','Api\BranchApiController@active_inactive');

Route::post('/employee', 'Api\EmployeeApiController@employee'); 

// Route::post('/job_list','Api\JobApplicationApiController@job_application_list');

// Route::post('/job_detail/{id}','Api\JobApplicationApiController@job_application_detail');

// Route::post('/time_in','Api\TimeInApiController@time_in');

// Route::post('/check_in_out','Api\TimeInApiController@check_in_out');

// Route::post('/time_out','Api\TimeInApiController@time_out');

// Route::post('/attendance_list','Api\TimeInApiController@attendance_list');

// Route::post('/attendance_dashboard','Api\TimeInApiController@attendance_dashboard');

// Route::post('/leave_list','Api\LeaveApiController@leave_list');
// Route::post('/leave_create','Api\LeaveApiController@leave_create');
// Route::post('/leave_edit/{id}','Api\LeaveApiController@leave_edit');
// Route::delete('/leave_delete/{id}','Api\LeaveApiController@leave_delete');

// Route::post('/offday_list','Api\OffDayApiController@offday_list');

// Route::post('/overtime_list','Api\OvertimeApiController@overtime_list');

// Route::post('/overtime_create','Api\OvertimeApiController@overtime_create');

// Route::get('/leave_type','Api\LeaveApiController@leave_type');

// Route::post('/emp_off_day','Api\OffDayApiController@emp_off_day');

// Route::post('/emp_leave_day','Api\LeaveApiController@emp_leave_day');

// Route::post('/emp_overtime_day','Api\OvertimeApiController@emp_overtime_day');

// Route::post('/check_off_day','Api\OffDayApiController@check_off_day');

// Route::post('/ro_list','Api\RoApiController@ro_list');

// Route::post('/ro_manage_list','Api\RoApiController@ro_manage_list');

// Route::post('/notice_board','Api\NoticeBoardApiController@notice_board');

// //ro backup
// Route::post('ro_member_list','Api\RoApiController@ro_member_list');

// Route::post('/emp_attendance_list','Api\TimeInApiController@emp_attendance_list');

// Route::post('/token_create','Api\NotiApiController@token_create');

// Route::get('/get_noti_count','Api\NoticeBoardApiController@get_noti_count');

// Route::post('/branch_employee','Api\BranchApiController@branch_employee');

// Route::post('/dept_employee','Api\DepartmentApiController@dept_employee');
