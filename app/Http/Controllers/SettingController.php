<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{

	public function setting()
	{
		$setting = Setting::first();
		return view('admin.setting.index',compact('setting'));
	}

	public function settingUpdate(Request $request,$id)
    {

        //  $rules = [
        //     'title'=>'required',
        //     'description'=>'required',
        //     // 'logo'=>'required',
        //     // 'favicon'=>'required',
        //     'api_url'=>'required'

        // ];

        //  $this->validate($request,$rules);
        //  
    	$setting=Setting::find($id);
        $attachPath = public_path() . '/uploads/setting/';
        $app_logo = $setting->logo;
        if ($file = $request->file('logo')) {
            $logo = $request->file('logo');
            $ext = '.'.$request->logo->getClientOriginalExtension();
            $fileName = 'app_logo'.$ext;
            $file->move($attachPath, $fileName);
            $app_logo = $fileName;
        }

        $favicon = $setting->favicon;
        if ($file = $request->file('favicon')) {
            $favicon = $request->file('favicon');
            $ext = '.'.$request->favicon->getClientOriginalExtension();
            $fileName = 'favicon'.$ext;
            $file->move($attachPath, $fileName);
            $favicon = $fileName;
        }

       
        $setting=$setting->update([
	            'title'=> $request->title,
	            'description'=> $request->description,
	            'logo'=>$app_logo,
	            'favicon'=>$favicon,
	            'api_url'=>$request->api_url,
                'actual_timein'=>$request->actual_timein
	        ]
        );

        
        return redirect()->route('setting.index')->with('success','Setting  updated successfully');
    }
}
