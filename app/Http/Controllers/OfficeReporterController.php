<?php

namespace App\Http\Controllers;

use App\OfficeReporter;
use App\Employee;
use App\Branch;
use App\Department;
use App\ROMember;
use Illuminate\Http\Request;
use Validator;
use DB;

class OfficeReporterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->name);
        $office_reporters = new OfficeReporter();
        $ro_members = ROMember::all();
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();


        
        $office_reporters = $office_reporters->leftjoin('employee','employee.id','=','office_reporters.ro_id')
            ->leftjoin('branch','branch.id','=','office_reporters.branch_id')->leftjoin('department','department.id','=','office_reporters.dept_id')
            ->select(
                'office_reporters.*',
                'branch.name AS branch_name',
                'department.name AS department',
                'employee.name AS ro_name',
                'employee.photo',
            );

        if ($request->name != '') {
            $office_reporters = $office_reporters->where('employee.name','like','%'.$request->name.'%');
            // dd($office_reporters->get());
        }

         if ($request->branch_id != '') {
            $office_reporters = $office_reporters->where('employee.branch_id',$request->branch_id);
            // dd($office_reporters->get());
        }
         
        if ($request->dept_id != '') {
            $office_reporters = $office_reporters->where('employee.dep_id',$request->dept_id);
        }
        
            // dd($office_reporters);
        $office_reporters = $office_reporters->orderBy('branch.name','asc')->get();
            // dd($office_reporters);
        return view('admin.ro.index',compact('office_reporters','ro_members','departments','branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        $branchs = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        return view('admin.ro.create',compact('employees','branchs','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
           'emp_id'=> 'required',
            'branch_id' => 'required',
            'department_id' => 'required',
            'ro_id' =>'required',
        ];
         $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()){
              DB::beginTransaction();
              try {

                   $office_reporters = OfficeReporter::create([
                        'branch_id'=>$request->branch_id,
                        'dept_id'=>$request->department_id,
                        'ro_id'=>$request->ro_id
                   ]);
                   foreach ($request->emp_id as $key => $value) {
                       $ro_members = ROMember::create([
                        'ro_id'=>$office_reporters->id,
                        'repoter_id'=>$office_reporters->ro_id,
                        'member_id'=>$value
                    ]);
                   }
                   
                  DB::commit();
              } catch (Exception $e) {
                  DB::rollback();
                    return redirect()->route('ro.index')->with('success','Successfully');
              }
              return redirect()->route('ro.index')->with('success','Successfully');
          }else{
             return redirect()->route('ro.create');
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OfficeReporter  $officeReporter
     * @return \Illuminate\Http\Response
     */
    public function show(OfficeReporter $officeReporter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OfficeReporter  $officeReporter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $office_reporters = OfficeReporter::find($id);
        $branches = Branch::where('status',1)->get();
        $employees = Employee::all();
        $ro_members = ROMember::where('ro_id',$id)->get();
        // dd($ro_members);
        $departments = Department::where('status',1)->orderBy('name','asc')->get();
        // dd($office_reporters);

        return view('admin.ro.edit',compact('branches','departments','office_reporters','employees','ro_members'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OfficeReporter  $officeReporter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $rules = [
            'ro_id' =>'required',
        ];
        // dd($request->all());
         $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()){
            // dd("here");
              DB::beginTransaction();
              try {
                   $office_reporters = OfficeReporter::find($id);
                   $office_reporters = $office_reporters->update([
                        'branch_id'=>$request->branch_id,
                        'dept_id'=>$request->dept_id,
                        'ro_id'=>$request->ro_id
                   ]);
                   $ro_members = ROMember::where('ro_id',$id)->delete();
                   foreach ($request->emp_id as $key => $value) {
                       $ro_members = ROMember::create([
                        'ro_id'=>$id,
                        'repoter_id'=>$request->ro_id,
                        'member_id'=>$value
                    ]);
                       // dd($ro_members);
                   }
                   
                  DB::commit();
              } catch (Exception $e) {
                  DB::rollback();
                    return redirect()->route('ro.index')->with('success','Successfully');
              }
              return redirect()->route('ro.index')->with('success','Successfully');
          }else{
             return redirect()->route('ro.index');
          }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OfficeReporter  $officeReporter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $office_reporters = OfficeReporter::find($id);
         $office_reporters->delete();
         $ro_members = ROMember::where('ro_id',$id);
         $ro_members->delete();
         return redirect()->route('ro.index')->with('success','Success');
    }
}
