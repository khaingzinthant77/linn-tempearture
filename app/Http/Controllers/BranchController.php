<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Employee;
use Illuminate\Http\Request;

class BranchController extends Controller
{
      public function __construct() 
    {
      $this->middleware('permission:branch-list|branch-create|branch-edit|branch-delete', ['only' => ['index','show']]);
      $this->middleware('permission:branch-create', ['only' => ['create','store']]);
      $this->middleware('permission:branch-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:branch-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branchs = new Branch();
        if ($request->name != '') {
            $branchs = $branchs->where('name','like','%'.$request->name.'%');
        }
        $count=$branchs->get()->count();
        $branchs = $branchs->orderBy('created_at','desc')->paginate(10);
        // dd($count);
        return view('admin.branch.index',compact('count','branchs'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.branch.create');
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
            'name'=>'required',
        ];

         $this->validate($request,$rules);
        $branch=Branch::create([
            'name'=> $request->name,
            'phone'=>$request->phone,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'branch_color'=>$request->color_code
        ]
        );
        return redirect()->route('branch.index')->with('success','Branch created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $branchs=Branch::find($id);
        return view('admin.branch.edit',compact('branchs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $rules = [
            'name'=>'required',
        ];

         $this->validate($request,$rules);

       $branchs=Branch::find($id);
        $branchs=$branchs->update([
            'name'=> $request->name,
            'phone'=> $request->phone,
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'branch_color'=>$request->color_code
        ]);
         return redirect()->route('branch.index')->with('success','Branch updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('branch_id',$id)->get();
        if (count($employee)>0) {
            return redirect()->route('branch.index')
                        ->with('error','Branch cannot delete!!!');
        }else{
         $branch = Branch::find($id)->delete();
         return redirect()->route('branch.index')
                        ->with('success','Branch deleted successfully');
        }
    }

    public function changestatusactive(Request $request)
    {
        $branch = Branch::find($request->branch_id);
        $branch->status = $request->status;

        $branch->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
