<?php

namespace App\Http\Controllers;

use App\Award;
use App\Employee;
use App\Branch;
use App\Department;
use App\Position;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function __construct() 
    {
      $this->middleware('permission:award-list|award-create|award-edit|award-delete', ['only' => ['index','show']]);
      $this->middleware('permission:award-create', ['only' => ['create','store']]);
      $this->middleware('permission:award-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:award-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd("Here");
        $awards = new Award();
        
        $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        $awards = $awards->leftjoin('employee','employee.id','=','awards.emp_id')
                        ->select(
                            'awards.*',
                            'employee.name',
                            'employee.photo'
                        );
        if ($request->name != '') {
            $awards = $awards->where('awards.award_name','like','%'.$request->name.'%')->orwhere('employee.name','like','%'.$request->name.'%')->orwhere('awards.gift','like','%'.$request->name.'%')->orwhere('awards.cash_price','like','%'.$request->name.'%');
        }
        if ($request->branch_id != '') {
            $awards = $awards->where('awards.branch_id',$request->branch_id);
        }
        if ($request->dept_id != '') {
            $awards = $awards->where('awards.dept_id',$request->dept_id);
        }
        $count=$awards->get()->count();
        $awards = $awards->orderBy('created_at','desc')->paginate(10);
        // dd($count);
        return view('admin.award.index',compact('count','awards','branches','departments'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.award.create');
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
        $this->validate($request,[
            'emp_id'=>'required',
            'award_name'=>'required'
        ]);
        $award = Award::create([
            'emp_id'=>$request->emp_id,
            'award_name'=>$request->award_name,
            'gift'=>$request->gift?$request->gift:"",
            'cash_price'=>$request->cash_price?$request->cash_price:"",
            'month'=>$request->month?$request->month:"",
            'year'=>$request->year?$request->year:"",
            'branch_id'=>$request->branch_id,
            'dept_id'=>$request->dep_id,
            'position_id'=>$request->position_id
        ]);
        return redirect()->route('award.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $award = Award::find($id);
        return view('admin.award.show',compact('award'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::all();
        $award = Award::find($id);
        return view('admin.award.edit',compact('award','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'emp_id'=>'required',
            'award_name'=>'required'
        ]);
        $award = Award::find($id);
        $award = $award->update([
            'emp_id'=>$request->emp_id,
            'award_name'=>$request->award_name,
            'gift'=>$request->gift?$request->gift:"",
            'cash_price'=>$request->cash_price?$request->cash_price:"",
            'month'=>$request->month?$request->month:"",
            'year'=>$request->year?$request->year:"",
            'branch_id'=>$request->branch_id,
            'dept_id'=>$request->dep_id,
            'position_id'=>$request->position_id
        ]);
        return redirect()->route('award.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Award  $award
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $award = Award::find($id)->delete();
        return redirect()->route('award.index')->with('success','Success');
    }
}
