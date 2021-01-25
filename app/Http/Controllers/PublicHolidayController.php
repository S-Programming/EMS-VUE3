<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\PublicHolidayService;
use App\Models\PublicHoliday;
use Illuminate\Support\Facades\Validator;


class PublicHolidayController extends Controller
{
    //
    protected $publicHolidayService;

    public function __construct(PublicHolidayService $publicHolidayService)
    {
        $this->middleware('auth');
        $this->publicHolidayService = $publicHolidayService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidays = PublicHoliday::all();
        return view('pages.publicHolidays.public_holidays')->with('holidays', $holidays);
    }
    /**
     * It will return a HTML for the Modal container
     *
     * @return Body
     */
    public function publicHolidayModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
         $html = view('pages.admin._partial._add_holiday_modal', ['id' => $containerId, 'data' => null])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    /**
     * Method for the Adding Users
     *
     * @return Body
     */
    public function confirmAddPublicHoliday(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'date' => 'required',   
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->publicHolidayService->confirmAddPublicHoliday($request));
    }

    /**
     * It will return a HTML for the Modal container for confirmation of deletion
     *
     * @return Body
     */
    public function publicHolidayDeleteModal(Request $request)
    {
        return $this->sendJsonResponse($this->publicHolidayService->publicHolidayDeleteModal($request));
    }
    /**
     * Method for the Deleting Users
     *
     * @return Body
     */
    public function confirmDeletePublicHoliday(Request $request)
    {
        //dd($request);
        return $this->sendJsonResponse($this->publicHolidayService->confirmDeletePublicHoliday($request));
    }
     /**
     * Method for Editing Public Holiday on Modal PoPUP
     *
     * @return Body
     */
    public function publicHolidayEditModal(Request $request)
    {
        return $this->sendJsonResponse($this->publicHolidayService->publicHolidayEditModal($request));
    }
    /**
     * Method for Update Public Holiday
     *
     * @return Body
     */
    public function publicHolidayUpdate(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'date' => 'required',   
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->publicHolidayService->publicHolidayUpdate($request));
    }

}
