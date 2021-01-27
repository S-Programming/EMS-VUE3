<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\HolidayService;
use App\Models\Holiday;
use Illuminate\Support\Facades\Validator;


class HolidayController extends Controller
{
    //
    protected $publicHolidayService;

    public function __construct(HolidayService $holidayService)
    {
        $this->middleware('auth');
        $this->holidayService = $holidayService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holidays = Holiday::all();
        return view('pages.holidays.holidays')->with('holidays', $holidays);
    }
    /**
     * It will return a HTML for the Modal container
     *
     * @return Body
     */
    public function holidayModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
         $html = view('pages.admin._partial._add_holiday_modal', ['id' => $containerId, 'data' => null])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    /**
     * Method for the Adding holidays
     *
     * @return Body
     */
    public function confirmAddHoliday(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'date_range' => 'required',   
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->holidayService->confirmAddHoliday($request));
    }

    /**
     * It will return a HTML for the Modal container for confirmation of deletion
     *
     * @return Body
     */
    public function holidayDeleteModal(Request $request)
    {
        return $this->sendJsonResponse($this->holidayService->holidayDeleteModal($request));
    }
    /**
     * Method for the Deleting holidays
     *
     * @return Body
     */
    public function confirmDeleteHoliday(Request $request)
    {
        //dd($request);
        return $this->sendJsonResponse($this->holidayService->confirmDeleteHoliday($request));
    }
     /**
     * Method for Editing  Holiday on Modal PoPUP
     *
     * @return Body
     */
    public function holidayEditModal(Request $request)
    {
        return $this->sendJsonResponse($this->holidayService->holidayEditModal($request));
    }
    /**
     * Method for Update  Holiday
     *
     * @return Body
     */
    public function holidayUpdate(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:50',
            'date' => 'required',   
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->holidayService->holidayUpdate($request));
    }

}
