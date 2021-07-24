<?php

namespace App\Http\Controllers;

use App\Room;
use App\Hostel;
use App\HoselEmployee;
use Illuminate\Http\Request;

class RoomController extends Controller
{
     public function __construct() 
    {
      $this->middleware('permission:room-list|room-create|room-edit|room-delete', ['only' => ['index','show']]);
      $this->middleware('permission:room-create', ['only' => ['create','store']]);
      $this->middleware('permission:room-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:room-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rooms = new Room();
        $count=$rooms->get()->count();
        if ($request->name != '') {
            $rooms = $rooms->where('name','like','%'.$request->name.'%');
        }
        $rooms = $rooms->orderBy('created_at','desc')->paginate(10);
        
        return view('admin.room.index',compact('count','rooms'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hostels = Hostel::all();
        return view('admin.room.create',compact('hostels'));
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
            'hostel_id'=>'required',
            'room_no'=>'required',
        ];
        // dd($request->all());
        $this->validate($request,$rules);
        $nrcstate=Room::create([
            'hostel_id'=>$request->hostel_id,
            'room_no'=> $request->room_no,
        ]
        );
        return redirect()->route('room.index')->with('success','Room created successfully');;;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rooms=Room::find($id);
        $hostels = Hostel::all();
        return view('admin.room.edit',compact('hostels','rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rooms=Room::find($id);
        $rooms=$rooms->update($request->all());
        return redirect()->route('room.index')->with('success','Room updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $hostelemployee = HoselEmployee::where('room_id',$id)->get();
        if (count($hostelemployee)>0) {
            return redirect()->route('room.index')
                        ->with('error','Room cannot delete!!!');
        }else{
         $room = Room::find($id)->delete();
         return redirect()->route('room.index')
                        ->with('success','Room deleted successfully');
        }
      
    }
}
