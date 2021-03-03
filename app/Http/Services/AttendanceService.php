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
		if (!isset($request) && empty($request)) {
            return $this->errorResponse('Attendance Request Failed');
        }
        if (isset($request) && !empty($request)) {
			foreach ($this->getAllUsers() as $User) {
	            $verify_user_presence = Attendance::where('user_id', $User->id)
	                ->whereDate('created_at', Carbon::today())->first();
	            if (!$verify_user_presence) {
	                $add_entry = new Attendance;
	                $add_entry->user_id = $User->id;
	                $add_entry->is_present = '0';
	                $add_entry->entry_ip = '';
	                $add_entry->entry_location = '';
	                $add_entry->exit_ip = '';
	                $add_entry->exit_location = '';
	                $add_entry->created_at = Carbon::now();
	                $add_entry->save();
	            }
	        }
	        $today_attendance  = Attendance::whereDate('created_at', Carbon::today())->orderBy("user_id", "asc")->get();
	        $html = view('pages.attendance._partial._user_attendance_html', ['attendance' => $today_attendance ])->render();
	         return  $html;
        }
	}

	 public function getUserAttendanceHistory(Request $request)
    {
        $user_id = $request->user_id;

        if ($request->user_days == 'Current Month') {
            // Current Month data with Specific User
            if ($user_id != 'All') {

                $current_monthl_attendance = Attendance::orderBy('user_id', 'asc')->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString())
                    ->where('user_id', $user_id)->get();


            } else {
                $current_monthl_attendance = Attendance::orderBy('user_id', 'asc')->where('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString())
                    ->get();
            }
            $count = $current_monthl_attendance->count();
            $html = view('pages.attendance._partial._user_attendance_html', ['attendance' => $current_monthl_attendance])->render();
            if ($count > 0) {
                return $this->successResponse('Current Month Attendance Received successfully', ['html' => $html, 'html_section_id' => 'attendance-section']);
            } else {
                return $this->errorResponse('Current Month Attendance Not Exists', ['errors' => ['Current Month Checkin_History Not Exists'], 'html' => $html, 'html_section_id' => 'attendance-section']);
            }
        } elseif ($request->user_days == 'Previous Month') {
            //Previous Month data with Specific User
            if ($user_id != 'All') {
                // dd('P Not All');
                $previous_month_attendance = Attendance::orderBy('user_id', 'asc')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
                    ->where('user_id', $user_id)
                    ->get();
            } else {
                $previous_month_attendance = Attendance::orderBy('user_id', 'asc')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)
                    ->get();
            }
            $count = $previous_month_attendance->count();
            $html = view('pages.attendance._partial._user_attendance_html', ['attendance' => $previous_month_attendance])->render();
            if ($count > 0) {
                return $this->successResponse('Previous Month Checkin_History Received successfully', ['html' => $html, 'html_section_id' => 'attendance-section']);
            } else {
                return $this->errorResponse('Previous Month Checkin_History Not Exists', ['errors' => ['History Not Exists'], 'html' => $html, 'html_section_id' => 'attendance-section']);
            }
        }


    }
}
