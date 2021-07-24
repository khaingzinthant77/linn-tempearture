<?php

namespace App\Http\Controllers;

use App\Hostel;
use App\HoselEmployee;
use Illuminate\Http\Request;
use File;

class HostelController extends Controller
{
     public function __construct() 
    {
      $this->middleware('permission:hostel-list|hostel-create|hostel-edit|hostel-delete', ['only' => ['index','show']]);
      $this->middleware('permission:hostel-create', ['only' => ['create','store']]);
      $this->middleware('permission:hostel-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:hostel-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hostels = new Hostel();
        $count=$hostels->get()->count();
        if ($request->name != '') {
            $hostels = $hostels->where('name','like','%'.$request->name.'%');
        }
        $hostels = $hostels->orderBy('created_at','desc')->paginate(10);
        
        return view('admin.hostel.index',compact('count','hostels'))->with('i', (request()->input('page', 1) - 1) * 10);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hostel.create');
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
            'full_address'=>'required'
        ];

        $this->validate($request,$rules);

        $filename="img_".date("Y-m-d-H-m-s");
            $path="uploads/hostel/".$filename;
            // dd($path);

            if(!File::isDirectory($path)){
                File::makeDirectory($path, 0777, true, true);
            }
            $photo = "";
            //upload image
            if ($file = $request->file('photo')) {
                $extension = $file->getClientOriginalExtension();
                $safeName = 'img'.'.' . $extension;
                $file->move($path, $safeName);
                $photo = $safeName;
            }
        $hostel=Hostel::create([
            'name'=> $request->name,
            'full_address'=>$request->full_address,
            'path'=>$path,
            'photo'=>$photo
        ]
        );
        return redirect()->route('hostel.index')->with('success','Hostel created successfully');;;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function show(Hostel $hostel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hostels=Hostel::find($id);
        return view('admin.hostel.edit',compact('hostels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $filename="img_".date("Y-m-d-H-m-s");
        $path="uploads/hostel/".$filename;

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        $hostels=Hostel::find($id);

        $photo = $hostels->photo;
        //upload image
        if ($file = $request->file('photo')) {
            // dd("Here");
            $extension = $file->getClientOriginalExtension();
            $safeName =  'img'.'.' . $extension;
            $file->move($path, $safeName);
            $photo = $safeName;
        }
         $hostels=$hostels->update([
            'name'=>$request->name,
            'full_address'=> $request->full_address,
            'path'=>$path,
            'photo'=>$photo
        ]
        );
         return redirect()->route('hostel.index')->with('success','Hostel updated successfully');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hostel  $hostel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hostelemployee = HoselEmployee::where('hostel_id',$id)->get();
        if (count($hostelemployee)>0) {
            return redirect()->route('hostel.index')
                        ->with('error','Hostel cannot delete!!!');
        }else{
         // $hostel = Hostel::find($id)->delete();
            $storagePath = public_path() . '/uploads/hostel/';

                $hostel = Hostel::find($id);
            if (File::exists($storagePath . $hostel->photo)) {
                File::delete($storagePath . $hostel->photo);
            };
         return redirect()->route('hostel.index')
                        ->with('success','Hostel deleted successfully');
        }
    }
}
