<?php

namespace App\Http\Controllers;

use App\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $leave_types = new LeaveType();
        $count=$leave_types->get()->count();
        $leave_types = $leave_types->orderBy('created_at','desc')->paginate(10);
        return view('admin.leave_type.index',compact('count','leave_types'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.leave_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'leave_type'=>'required',
            'num_of_leave'=>'required'
        ];

        $this->validate($request,$rules);
        $leaveType = LeaveType::create([
            'leave_type'=>$request->leave_type,
            'num_of_leave'=>$request->num_of_leave
        ]);
        return redirect()->route('leave_type.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leave_type = LeaveType::find($id);
        return view('admin.leave_type.show',compact('leave_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leave_type = LeaveType::find($id);
        return view('admin.leave_type.edit',compact('leave_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'leave_type'=>'required',
            'num_of_leave'=>'required'
        ]);
        $leave_type = LeaveType::find($id);
        $leave_type = $leave_type->update([
            'leave_type'=>$request->leave_type,
            'num_of_leave'=>$request->num_of_leave
        ]);
    return redirect()->route('leave_type.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeaveType  $leaveType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leave_type = LeaveType::find($id)->delete();
        return redirect()->route('leave_type.index')->with('success','Success');
    }
}
