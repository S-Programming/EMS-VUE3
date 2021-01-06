<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CheckinHistory;
use http\Message\Body;
use Carbon\Carbon;
use Session; 

class CheckinHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function index()
    {
    	
    } 
    /**
     * It will return a HTML for the Modal container
     *
     * @return Body
     */
    public function checkinModal(Request $request)
    {
        //dd("saddd");
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
        ## DB operations
        $cico = new CheckinHistory;
        $cico->checkin = Carbon::now();
        $cico->user_id =  Auth::user()->id ?? 0;
        $cico->save();
        return $this->success('success');
        
    }
    /**
     * It will return a HTML for the Modal container
     *
     * @return Body
     */
    public function checkoutModal(Request $request)
    {
         $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.user._partial._checkout_modal', ['id' => $containerId, 'data' => null])->render();
        return $this->success('success', ['html' => $html]);

    }
    /**
     * Checking Method for the users to checkout
     *
     * @return Body
     */
    public function confirmCheckout(Request $request)
    {
        
        $user_id =  Auth::user()->id ?? 0;
        $cico = CheckinHistory::where('user_id',$user_id)->first();
        $cico->checkout = Carbon::now();    
        $cico->description = $request->description;
        $cico->save();
        return $this->success('success');
        
    }
}