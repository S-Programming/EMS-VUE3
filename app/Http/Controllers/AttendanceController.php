<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Attendance;
use App\Http\Services\AttendanceService;
use Carbon\Carbon;
use location;


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
    public function index(Request $request)
    {
        $cureent_date = Carbon::now()->toTimeString();

        // $ip = $request->ip();
        // dd($ip);
        // $ip = getHostByName(getHostName());
        $ipAddress = $request->ip();
        $ip = '127.0.0.1';
        $data = \Location::get($ip);
        dd($data);

        // $ip = $this->iplookup();
        // $args['country_code'] = $ip['countryAbbr'] ?? '';
        // $args['state_code'] = $ip['stateAbbr'] ?? '';
        // $args['zip_code'] = $ip['cityAbbr'] ?? '';
        // $args['time_zone'] = $ip['time_zone'] ?? '';
        // $args['ip'] = $ip['ip'] ?? '';

        // dd($ip);


        return view('pages.attendance.attendance_mark')->with(['cureent_date' => $cureent_date]);
    }


    // public function iplookup($this_ip = null)
    // {

    //     // This creates the Reader object, which should be reused across
    //     // lookups.
    //     $reader = new Reader(base_path() . '/public/geoip/GeoLite2-City.mmdb');

    //     // Replace "city" with the appropriate method for your database, e.g.,
    //     // "country".

    //     if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
    //         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    //     } else {
    //         if (isset($_SERVER['REMOTE_ADDR'])) {
    //             $ip =  $_SERVER['REMOTE_ADDR'];
    //         } else {
    //             $ip = "24.4.84.172";
    //         }
    //     }
    //     if (isset($this_ip)) {
    //         $ip = $this_ip;
    //     }

    //     $ip_comma = strpos($ip, ",");

    //     if (isset($ip_comma) && $ip_comma != '') {
    //         $to_remove = substr($ip, $ip_comma, strlen($ip) - $ip_comma);
    //         $ip = str_replace($to_remove, '', $ip);
    //     }

    //     $privateIP = $this->checkForPrivateIP($ip);
    //     //If remote IP fails we default to office IP.
    //     if ($ip == '::1' || $privateIP) {
    //         $ip = '50.0.50.17';
    //     }

    //     // ip lookup fixups
    //     if (strpos($ip, ',') !== FALSE) {

    //         $comma = strpos($ip, ',');
    //         if (strpos($ip, ':') !== FALSE) {

    //             $ip = substr($ip, $comma + 2, strlen($ip));
    //         } else {

    //             $ip = substr($ip, 0, $comma);
    //         }
    //     }

    //     // Check if session has geolocation
    //     if (!isset($this_ip) && Session::has('ip_lookup')) {
    //         $ret = Session::get('ip_lookup');
    //         $ret['ip'] = $ip;

    //         return $ret;
    //     }

    //     $excp = false;
    //     try {
    //         $record = $reader->city($ip);
    //     } catch (\Exception $e) {
    //         $excp = true;
    //     }

    //     if (
    //         !isset($record->country->isoCode) && !isset($record->country->name) && !isset($record->mostSpecificSubdivision->name) && !isset($record->mostSpecificSubdivision->isoCode) &&  !isset($record->city->name) &&
    //         !isset($record->postal->code) && !isset($record->location->latitude) && !isset($record->location->longitude)
    //         && !isset($record->location->timeZone)
    //     ) {
    //         $excp = true;
    //     }
    //     //dd($record->city->name. ' city | latitude ' .$record->location->latitude . '  | longitude  ' .$record->location->longitude);
    //     $arr = array();
    //     if ($excp === true) {
    //         $record = $reader->city('50.161.86.17');
    //     }

    //     $arr['countryAbbr'] = $record->country->isoCode;
    //     $arr['countryName'] = $record->country->name;

    //     $arr['stateName'] = $record->mostSpecificSubdivision->name;
    //     $arr['stateAbbr'] = $record->mostSpecificSubdivision->isoCode;
    //     $arr['cityName'] = $record->city->name;
    //     if ($excp === true) {
    //         $arr['cityName'] .= '-Forced';
    //     }
    //     $arr['cityAbbr'] = $record->postal->code;
    //     $arr['latitude'] = $record->location->latitude ?? '';
    //     $arr['longitude'] = $record->location->longitude ?? '';
    //     $arr['time_zone'] = $record->location->timeZone ?? '';
    //     $arr['ip'] = $ip;
    //     /*
    //     print($record->country->isoCode . "\n"); // 'US'
    //     print($record->country->name . "\n"); // 'United States'
    //     print($record->country->names['zh-CN'] . "\n"); // '美国'

    //     print($record->mostSpecificSubdivision->name . "\n"); // 'Minnesota'
    //     print($record->mostSpecificSubdivision->isoCode . "\n"); // 'MN'

    //     print($record->city->name . "\n"); // 'Minneapolis'

    //     print($record->postal->code . "\n"); // '55455'

    //     print($record->location->latitude . "\n"); // 44.9733
    //     print($record->location->longitude . "\n"); // -93.2323
    //     */
    //     return $arr;
    // }


    public function markAttendance(Request $request)
    {
        $attendance = new attendance;
        $attendance->entry_ip = $request->ip();
        dd($attendance);
    }
    public function location(Request $request)
    {

        $response = Http::get('https://nominatim.openstreetmap.org/reverse?format=geojson&lat=' . $request->lat . '&lon=' . $request->lon);
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
        return view('pages.attendance.attendance', ['user_attendance_history_html' => $user_attendance_history_html, 'users' => $this->getAllUsers()]);
    }
    //Get User Attendance Monthly Wise
    public function getUserAttendanceHistory(Request $request)
    {
        return $this->sendJsonResponse($this->attendanceService->getUserAttendanceHistory($request));
    }
}
