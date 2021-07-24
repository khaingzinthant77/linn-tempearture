<?php

namespace App\Http\Controllers;

use App\Jobopening;
use App\Department;
use App\Position;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;

class JobopeningController extends Controller
{
     public function __construct() 
    {
      $this->middleware('permission:jobopen-list|jobopen-create|jobopen-edit|jobopen-delete', ['only' => ['index','show']]);
      $this->middleware('permission:jobopen-create', ['only' => ['create','store']]);
      $this->middleware('permission:jobopen-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:jobopen-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $jobopenings = new Jobopening();
        $departments = Department::all();
        
         if ($request->dep_id != '') {
            $jobopenings = $jobopenings->where('dep_id','like','%'.$request->dep_id.'%');
        }
        $count=$jobopenings->get()->count();
        $jobopenings = $jobopenings->orderBy('created_at','desc')->paginate(10);
        
        return view('admin.jobopening.index',compact('count','jobopenings','departments'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        return view('admin.jobopening.create',compact('departments','positions'));
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
        $destinationPath = public_path() . '/uploads/jobopeningPhoto/';
        $photo = "";
        //upload image
        if ($file = $request->file('photo')) {
            $extension = $file->getClientOriginalExtension();
            $var = Str::random(32) . '.' . $extension;
            $file->move($destinationPath, $var);
            $photo = $var;
            // dd($photo);

        }

         $rules = [
            'dep_id'=>'required',
            'title'=>'required',
            'description'=>'required',
            'posted_date'=>'required',
            'last_date'=>'required',
            'close_date'=>'required',
           
        ];

         $this->validate($request,$rules);
        $jobopening=Jobopening::create([
            'dep_id'=> $request->dep_id,
            'position_id'=>$request->position_id,
            'title'=>$request->title,
            'description'=>$request->description,
            'posted_date'=>$request->posted_date,
            'last_date'=>$request->last_date,
            'close_date'=>$request->close_date,
            'photo'=>$photo,
            
        ]
        );
        // dd($jobopening);
        return redirect()->route('jobopening.index')->with('success','Jobopening created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Jobopening  $jobopening
     * @return \Illuminate\Http\Response
     */
    public function show(Jobopening $jobopening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jobopening  $jobopening
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobopenings=Jobopening::find($id);
      
        $departments = Department::all();
        $positions = Position::all();
        return view('admin.jobopening.edit',compact('jobopenings','departments','positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jobopening  $jobopening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jobopenings = Jobopening::find($id);
        $destinationPath = public_path() . '/uploads/jobopeningPhoto/';
        $photo = ($request->photo != '') ? $request->photo : $jobopenings->photo;
        //upload image
        if ($file = $request->file('photo')) {
            $extension = $file->getClientOriginalExtension();
            $var = Str::random(32) . '.' . $extension;
            
            $file->move($destinationPath, $var);
            $photo = $var;
        }
       
        $jobopenings=$jobopenings->update([
            'dep_id'=> $request->dep_id,
            'position_id'=>$request->position_id,
            'title'=>$request->title,
            'description'=>$request->description,
            'posted_date'=>$request->posted_date,
            'last_date'=>$request->last_date,
            'close_date'=>$request->close_date,
            'photo'=>$photo
        ]
        );
        return redirect()->route('jobopening.index')->with('success','Jobopening updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jobopening  $jobopening
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobopenings = Jobopening::find($id);
        $jobopenings->delete();
         return redirect()->route('jobopening.index')->with('success','Jobopening deleted successfully');
    }
}
