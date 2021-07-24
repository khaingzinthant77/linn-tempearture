<?php

namespace App\Http\Controllers;

use App\ActualTimeIn;
use Illuminate\Http\Request;

class ActualTimeInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actual_timeins = new ActualTimeIn();
        $count=$actual_timeins->get()->count();
        $actual_timeins = $actual_timeins->orderBy('created_at','desc')->paginate(10);
        return view('admin.actual_timein.index',compact('count','actual_timeins'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.actual_timein.create');
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
            'actual_timein'=>'required',
        ];
         $this->validate($request,$rules);
         $actual_timein = ActualTimeIn::create([
            'actual_timein'=>$request->actual_timein
         ]);
         return redirect()->route('actual_timein.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ActualTimeIn  $actualTimeIn
     * @return \Illuminate\Http\Response
     */
    public function show(ActualTimeIn $actualTimeIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActualTimeIn  $actualTimeIn
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $actual_timein = ActualTimeIn::find($id);
        return view('admin.actual_timein.edit',compact('actual_timein'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActualTimeIn  $actualTimeIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'actual_timein'=>'required',
        ];
         $this->validate($request,$rules);
         $actual_timein = ActualTimeIn::find($id);

         $actual_timein = $actual_timein->update([
            'actual_timein'=>$request->actual_timein
        ]);
         return redirect()->route('actual_timein.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActualTimeIn  $actualTimeIn
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actual_timein = ActualTimeIn::find($id)->delete();
        return redirect()->route('actual_timein.index')->with('success','Success');
    }
}
