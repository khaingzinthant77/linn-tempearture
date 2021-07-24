<?php

namespace App\Http\Controllers;

use App\NRCState;
use App\NRCCode;
use App\Employee;
use Illuminate\Http\Request;

class NRCStateController extends Controller
{
      public function __construct() 
    {
      $this->middleware('permission:nrc-state-list|nrc-state-create|nrc-state-edit|nrc-state-delete', ['only' => ['index','show']]);
      $this->middleware('permission:nrc-state-create', ['only' => ['create','store']]);
      $this->middleware('permission:nrc-state-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:nrc-state-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $codes = NRCCode::all();
        $nrcstates = new NRCState();
        $count=$nrcstates->get()->count();
        if ($request->name != '') {
            $nrcstates = $nrcstates->where('name','like','%'.$request->name.'%');
        }
        $nrcstates = $nrcstates->orderBy('created_at','desc')->paginate(10);
        
        return view('admin.nrcstate.index',compact('codes','count','nrcstates'))->with('i', (request()->input('page', 1) - 1) * 10);;;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $codes = NRCCode::all();
        return view('admin.nrcstate.create',compact('codes'));
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
            'code_id'=>'required',
            'name'=>'required',
        ];
        // dd($request->all());
        $this->validate($request,$rules);
        $nrcstate=NRCState::create([
            'code_id'=>$request->code_id,
            'name'=> $request->name,
        ]
        );
        return redirect()->route('nrcstate.index')->with('success','NrcState created successfully');;;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NRCState  $nRCState
     * @return \Illuminate\Http\Response
     */
    public function show(NRCState $nRCState)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NRCState  $nRCState
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nrcstates=NRCState::find($id);
        $codes = NRCCode::all();
        return view('admin.nrcstate.edit',compact('nrcstates','codes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NRCState  $nRCState
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nrcstates=NRCState::find($id);
        $nrcstates=$nrcstates->update($request->all());
        return redirect()->route('nrcstate.index')->with('success','NRCState updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NRCState  $nRCState
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('nrc_state',$id)->get();
        if (count($employee)>0) {
            return redirect()->route('nrcstate.index')
                        ->with('error','NRCState cannot delete!!!');
        }else{
         $nrcstate = NRCState::find($id)->delete();
         return redirect()->route('nrcstate.index')
                        ->with('success','NRCState deleted successfully');
        }
    }
}
