<?php

namespace App\Http\Controllers;

use App\Interview;
use App\Cvform;
use Illuminate\Http\Request;
use DB;
use Validator;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($Request->all());
         $rules = [
                    'emp_id'=>'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->passes()){
             DB::beginTransaction();
             try{
                    $interview=Interview::create([
                    'emp_id'=> $request->emp_id,
                    'step_id'=>$request->step_id,
                    'reason'=>$request->reason,
                    ]);
                   $employees = Cvform::find($request->emp_id);
                   $hostelemployee = Cvform::where('status',1)->get();
                   // dd($hostelemployee);
                    if ($hostelemployee->count() > 0){

                          $updatedata = $employees->update([
                            'status'=>2,
                          ]);
                    }else{
                         $updatedata = $employees->update([
                            'status'=>1,
                          ]);
                    }
                    
                     DB::commit();

             }catch (Exception $e) {
                  DB::rollback();
                    return redirect()->route('jobapplication.index')->with('success','Successfully');
             }
              return redirect()->route('jobapplication.index')->with('success','Successfully');

        }else{
            return redirect()->route('jobapplication.show');
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function show(Interview $interview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function edit(Interview $interview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interview $interview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interview $interview)
    {
        //
    }
}
