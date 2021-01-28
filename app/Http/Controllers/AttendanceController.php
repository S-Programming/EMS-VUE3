<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Attendance;
use App\Http\Services\AttendanceService;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    
    protected $attendanceService;
     public function __construct(AttendanceService $attendanceService)
    {
        $this->middleware('auth');
        $this->attendanceService = $attendanceService;
    }
   /**
    * Method use for marking attendance
    *
    * return body
    */
    public function index()
    {
    	return view('pages.attendance.attendance_mark');
    }
    public function markAttendance(Request $request)
    {
        $attendance = new attendance;
        $attendance->entry_ip = $request->ip();
        dd($attendance);
    }
    public function location(Request $request) {
        
        $response = Http::get('https://nominatim.openstreetmap.org/reverse?format=geojson&lat='.$request->lat.'&lon='.$request->lon);
         //dd($response);
        // $result = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $request->lat . ',' . $request->lon . '&key=AIzaSyC_spXZlR87VF9qq073nAhFGZ-f3K6enqk';
        // $file_contents = file_get_contents($result);

        // $json_decode = json_decode($file_contents);
        // echo  $json_decode->results[0]->formatted_address;
        // $response = array(
        //     'status' => 'success',
        //     'result' => $json_decode
        // );
        return $response->json()['features'][0]['properties']['display_name'];
    }

    public function verifyAttendance(Request $request)
    {
       $user_attendance_history_html =  $this->attendanceService->verifyAttendance($request);
       /*$user_attendance_history_html = $html['html'];*/
      // dd($user_attendance_history_html);
       return view('pages.attendance.attendance',['user_attendance_history_html'=> $user_attendance_history_html,'users' => $this->getAllUsers()]);
        
    }
    //Get User Attendance Monthly Wise
    public function getUserAttendanceHistory(Request $request)
    {
        return $this->sendJsonResponse($this->attendanceService->getUserAttendanceHistory($request));
    }
}
