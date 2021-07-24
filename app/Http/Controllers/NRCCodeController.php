<?php

namespace App\Http\Controllers;

use App\NRCCode;
use App\NRCState;
use Illuminate\Http\Request;

class NRCCodeController extends Controller
{
      public function __construct() 
    {
      $this->middleware('permission:nrc-code-list|nrc-code-create|nrc-code-edit|nrc-code-delete', ['only' => ['index','show']]);
      $this->middleware('permission:nrc-code-create', ['only' => ['create','store']]);
      $this->middleware('permission:nrc-code-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:nrc-code-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nrccodes = new NRCCode();
        $count=$nrccodes->get()->count();
        if ($request->name != '') {
            $nrccodes = $nrccodes->where('name','like','%'.$request->name.'%');
        }
        $nrccodes = $nrccodes->orderBy('created_at','desc')->paginate(10);
        
        return view('admin.nrccode.index',compact('count','nrccodes'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.nrccode.create');
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
        $nrccode=NRCCode::create([
            'name'=> $request->name,
        ]
        );
        return redirect()->route('nrccode.index')->with('success','NRCCode created successfully');;;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NRCCode  $nRCCode
     * @return \Illuminate\Http\Response
     */
    public function show(NRCCode $nRCCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NRCCode  $nRCCode
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nrccodes=NRCCode::find($id);
        return view('admin.nrccode.edit',compact('nrccodes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NRCCode  $nRCCode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nrccodes=NRCCode::find($id);
        $nrccodes=$nrccodes->update($request->all());
         return redirect()->route('nrccode.index')->with('success','NRCCode updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NRCCode  $nRCCode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nrcstate = NRCState::where('code_id',$id)->get();
        if (count($nrcstate)>0) {
            return redirect()->route('nrccode.index')
                        ->with('error','NRCCode cannot delete!!!');
        }else{
         $nrccode = NRCCode::find($id)->delete();
         return redirect()->route('nrccode.index')
                        ->with('success','NRCCode deleted successfully');
        }
    }
}
