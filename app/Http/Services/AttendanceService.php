<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceService extends BaseService
{
	public function verifyAttendance(Request $request)
	{
		if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Attendance Request Failed');
        }
        if (isset($request) && !empty($request)) {
			foreach ($this->getAllUsers() as $User) {
	            $verifyUserPresence = Attendance::where('user_id', $User->id)
	                ->whereDate('created_at', Carbon::today())->first();
	            if (!$verifyUserPresence) {
	                $addEntry = new Attendance;
	                $addEntry->user_id = $User->id;
	                $addEntry->is_present = '0';
	                $addEntry->entry_ip = '';
	                $addEntry->entry_location = '';
	                $addEntry->exit_ip = '';
	                $addEntry->exit_location = '';
	                $addEntry->created_at = Carbon::now();
	                $addEntry->save();
	            }
	        }
	        $todayAttendance  = Attendance::whereDate('created_at', Carbon::today())->orderBy("user_id", "asc")->get();
	        $html = view('pages.attendance._partial._user_attendance_html', ['todayAttendance' => $todayAttendance ])->render();
	         return  $html;
        } 

        //return view('pages.attendance.today_attendance_list')->with(['users' => $this->getAllUsers(), 'todayAttendance' => $todayAttendance]);
        
	}

	 public function getUserAttendanceHistory(Request $request)
    {
        $user_id = $request->user_id;
       
        if ($request->user_days == 'Current Month') {
            // Current Month data with Specific User
            if ($user_id != 'All') {
               
                $currentmonthlAttendance = Attendance::orderBy('user_id', 'asc')->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString())
                    ->where('user_id', $user_id)->get();

                
            } else {
                // dd('all with current month');
                $currentmonthlAttendance = Attendance::orderBy('user_id', 'asc')->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString())
                    ->get();
                // with('user')->
            }
            $count = $currentmonthlAttendance->count();
            $html = view('pages.attendance._partial._user_attendance_html', ['todayAttendance' => $currentmonthlAttendance])->render();
            if ($count > 0) {
                return $this->successResponse('Current Month Attendance Received successfully', ['html' => $html, 'html_section_id' => 'attendance-section']);
            } else {
                return $this->errorResponse('Current Month Attendance Not Exists', ['errors' => ['Current Month Checkin_History Not Exists'], 'html' => $html, 'html_section_id' => 'attendance-section']);
            }
        } elseif ($request->user_days == 'Previous Month') {
            //Previous Month data with Specific User
            if ($user_id != 'All') {
                // dd('P Not All');
                $previousMonthAttendance = Attendance::orderBy('user_id', 'asc')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
                    ->where('user_id', $user_id)
                    ->get();
            } else {
                // dd('P All');
                $previousMonthAttendance = Attendance::orderBy('user_id', 'asc')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
                    ->get();
            }
            $count = $previousMonthAttendance->count();
            $html = view('pages.attendance._partial._user_attendance_html', ['todayAttendance' => $previousMonthAttendance])->render();
            if ($count > 0) {
                return $this->successResponse('Previous Month Checkin_History Received successfully', ['html' => $html, 'html_section_id' => 'attendance-section']);
            } else {
                return $this->errorResponse('Previous Month Checkin_History Not Exists', ['errors' => ['History Not Exists'], 'html' => $html, 'html_section_id' => 'attendance-section']);
            }
        }


    }
}