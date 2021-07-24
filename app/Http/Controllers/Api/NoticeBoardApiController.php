<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\NoticeBoard;
use DB;
use Validator;
use App\Employee;


class NoticeBoardApiController extends Controller
{
	public function notice_board(Request $request)
	{
		$input = $request->all();
	     $rules=[
	        'page'=>'required',
	    ];

	    $validator = Validator::make($input, $rules);

	     if ($validator->fails()) {
	        $messages = $validator->messages();
	           return response()->json(['message'=>"Error",'status'=>0]);
	    }else{
	    	if ($request->page != 0) {
	    		
	    			$notice_boards = new NoticeBoard();
	    			$notice_boards = $notice_boards->where('notice_type',1)->orwhere('position_id',$request->position_id)->orwhere('dept_id',$request->dept_id)->orwhere('branch_id',$request->branch_id);
	    		
	    			$notice_boards = $notice_boards->orderBy('id','desc')->limit(10)->paginate(10);

		        return response(['message'=>"Success",'status'=>1,'notice_boards'=>$notice_boards]);
	    	}else{
		    		
		    			$notice_boards = new NoticeBoard();
		    			$notice_boards = $notice_boards->where('notice_type',1)->orwherewhere('position_id',$request->position_id)->orwhere('dept_id',$request->dept_id)->orwhere('branch_id',$request->branch_id);
		    		
		    		$notice_boards = $notice_boards->orderBy('attendances.id','desc')->get();

			        return response(['message'=>"Success",'status'=>1,'notice_boards'=>$notice_boards]);
	    	}
	    }
	}

	public function get_noti_count()
	{
		$date = now();
		$today_date = date('Y-m-d',strtotime($date));
		// dd($today_date);
		$noti_count = NoticeBoard::whereDate('publish_date',$today_date)->get()->count();

		 return response(['message'=>"Success",'status'=>1,'noti_count'=>$noti_count]);
	}
}