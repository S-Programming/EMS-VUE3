<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Attendence;


class AttendenceController extends Controller
{
    //
   /**
    * Method use for marking attendence
    *
    * return body
    */
    public function index()
    {
    	return view('pages.attendence.attendence_mark');
    }
    public function markAttendence(Request $request)
    {
        $attendence = new Attendence;
        $attendence->entry_ip = $request->ip();
        dd($attendence);
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
}
