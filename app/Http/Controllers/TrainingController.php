<?php
namespace App\Http\Controllers;
use App\Training;
use App\TrainingEmployee;
use App\Department;
use App\Branch;
use App\Position;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
     public function __construct() 
    {
      $this->middleware('permission:training-list|training-create|training-edit|training-delete', ['only' => ['index','show']]);
      $this->middleware('permission:training-create', ['only' => ['create','store']]);
      $this->middleware('permission:training-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:training-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $trainings = new Training();
        $count = $trainings->get()->count();
        if($request->name != '') {
        $trainings = $trainings->Where('name','like','%'.$request->name.'%')->orwhere('trainer_name','like','%'.$request->name.'%')->orwhere('trainer_info','like','%'.$request->name.'%');
        }

        if ($request->from_date != '' || $request->to_date != '') {
            $startDate =  date('Y-m-d', strtotime($request->from_date));
            $endDate = date('Y-m-d', strtotime($request->to_date));
            $trainings = Training::whereBetween('trainings.start_date',[$startDate,$endDate]);
            // dd($trainings);
        }

        $trainings = $trainings->orderBy('trainings.created_at','desc')->paginate(10);
        return view('admin.training.index',compact('count','trainings'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.training.create');
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
            'name'=>'required'
        ]);
        $training = Training::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'peroid'=>$request->peroid,
            'start_date'=>date('Y-m-d',strtotime($request->start_date)),
            'end_date'=>date('Y-m-d',strtotime($request->end_date)),
            'trainer_name'=>$request->trainer_name,
            'trainer_info'=>$request->trainer_info,
        ]);
        return redirect()->route('training.index')->with('success','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trainings = Training::find($id);
         $branches = Branch::where('status',1)->get();
        $departments = Department::where('status',1)->get();
         $positions = Position::All();
        $training_employees = TrainingEmployee::where('training_id',$id)->get();
        // dd($training_employees);
        return view('admin.training.show',compact('trainings','training_employees','branches','departments','positions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trainings = Training::find($id);
        return view('admin.training.edit',compact('trainings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required'
        ]);
        $trainings = Training::find($id)->update([
           'name'=>$request->name,
            'description'=>$request->description,
            'peroid'=>$request->peroid,
            'start_date'=>date('Y-m-d',strtotime($request->start_date)),
            'end_date'=>date('Y-m-d',strtotime($request->end_date)),
            'trainer_name'=>$request->trainer_name,
            'trainer_info'=>$request->trainer_info,
        ]);
        return redirect()->route('training.index')->with('success','Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainings = Training::find($id)->delete();
        return redirect()->route('training.index')->with('success','Success');
    }
}