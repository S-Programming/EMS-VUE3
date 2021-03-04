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
     * This method is used to  show all Request Status
     * To the user so that he apply leave request
     * according to them.
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
     * Display a popup modal to add new request status ].
     *
     * @return Body
     */
    public function addStatusModal(Request $request)
    {
        return $this->sendJsonResponse($this->requestStatusService->addStatusModal($request));
    }

    /**
     * Click Yes button to add request status confirmly.
     *
     * @return Body
     */
    public function statusConfirmAdd(Request $request)
    {
        return $this->sendJsonResponse($this->requestStatusService->statusConfirmAdd($request));
    }

    /**
     * Display a popup modal to edit request status.
     *
     * @return Body
     */
    public function editStatusModal(Request $request)
    {
        return $this->sendJsonResponse($this->requestStatusService->editStatusModal($request));
    }

    /**
     * Click Yes Button to edit or update request status confirmly.
     *
     * @return Body
     */
    public function statusUpdate(Request $request)
    {
        return $this->sendJsonResponse($this->requestStatusService->statusUpdate($request));
    }

    /**
     * Display a popup modal to delete Request Status.
     *
     * @return Body
     */
    public function statusDeleteModal(Request $request)
    {
        return $this->sendJsonResponse($this->requestStatusService->statusDeleteModal($request));
    }

    /**
     * Click Yes button to delete Request Status confirmly.
     *
     * @return Body
     */
    public function statusDeleteConfirm(Request $request)
    {
        return $this->sendJsonResponse($this->requestStatusService->statusDeleteConfirm($request));
    }
}
