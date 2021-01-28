<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\RequestStatusService;
use App\Models\RequestStatus;

class RequestStatusController extends Controller
{
    //
    protected $requestStatusService;

    public function __construct(RequestStatusService $requestStatusService)
    {
        $this->middleware('auth');
        $this->requestStatusService = $requestStatusService;
    }
    /**
     * It will return a Leave Status List
     *
     * @return Body
     */
    public function requestStatus()
    {

        //$leaves = LeaveType::with('history')->get();
        $request_status = RequestStatus::all();
        // dd($leave_type);
        return view('pages.requestStatus.request_status_list')->with('request_status', $request_status);
    }

    /**
     * It will return a HTML for the Leave Status Modal container
     *
     * @return Body
     */
    public function addStatusModal(Request $request)
    {
        return $this->sendJsonResponse($this->requestStatusService->addStatusModal($request));
    }

    /**
     * Method for the Adding Leave Status
     *
     * @return Body
     */
    public function statusConfirmAdd(Request $request)
    {
        return $this->sendJsonResponse($this->requestStatusService->statusConfirmAdd($request));
    }

    /**
     * Method for Editing Leave Status on Modal PoPUP
     *
     * @return Body
     */
    public function editStatusModal(Request $request)
    {
        return $this->sendJsonResponse($this->requestStatusService->editStatusModal($request));
    }

    /**
     * Method for Update Leave Status
     *
     * @return Body
     */
    public function statusUpdate(Request $request)
    {
        return $this->sendJsonResponse($this->requestStatusService->statusUpdate($request));
    }

    /**
     * It will return a HTML for the Modal container for confirmation of deletion
     *
     * @return Body
     */
    public function statusDeleteModal(Request $request)
    {
        return $this->sendJsonResponse($this->requestStatusService->statusDeleteModal($request));
    }

    /**
     * Method for the Deleting Leave Status
     *
     * @return Body
     */
    public function statusDeleteConfirm(Request $request)
    {
        return $this->sendJsonResponse($this->requestStatusService->statusDeleteConfirm($request));
    }
}
