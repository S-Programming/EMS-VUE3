<?php

namespace App\Http\Controllers;

use App\Http\Services\DashboardService;
use http\Message\Body;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cico;
use Carbon\Carbon;
use Session;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param DashboardService $dashboardService
     */
    public function __construct(DashboardService $dashboardService)
    {
        $this->middleware('auth');
        $this->dashboardService = $dashboardService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.user.dashboard');
    }

    /**
     * It will return a HTML for the Modal container
     *
     * @return Body
     */
    public function checkinModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.user._partial._checkin_modal', ['id' => $containerId, 'data' => null])->render();
        return $this->success('success', ['html' => $html]);
    }
    /**
     * Checking Method for the users to checkin
     *
     * @return Body
     */
    public function confirmCheckin(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        ## DB operations
        return $this->success('success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkin(Request $request)
    {

        $cico = new Cico;
        $cico->checkin = Carbon::now();
        $cico->user_id =  Auth::user()->id ?? 0;
        // dd($cico);
        $cico->save();


        return back()->with('success','Data save successfully');
    }
    public function checkout(Request $request)
    {

        $user_id =  Auth::user()->id ?? 0;
        $cico = Cico::where('user_id',$user_id)->first();
        $cico->checkout = Carbon::now();
        $cico->description = $request->description;
        $cico->save();


        return back()->with('success','Data save successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
