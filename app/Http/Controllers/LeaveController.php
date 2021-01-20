<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\LeaveService;
use App\Models\HistoryLeave;
use App\Models\LeaveHistory;
use App\Models\LeaveType;
use App\Models\HistoryLeaveType;

class LeaveController extends Controller
{
    protected $leaveService;

    public function __construct(LeaveService $leaveService)
    {
        $this->middleware('auth');
        $this->leaveService = $leaveService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = $this->getAuthUserId();
        //$leaves = LeaveType::with('history')->get();
        $leaves = LeaveHistory::with('type')->where('user_id', $user_id)->get();
        // dd($leaves);
        return view('pages.leave.leaves_list')->with('leaves', $leaves);
    }
    /**
     * It will return a HTML for the Modal container
     *
     * @return Body
     */
    public function addLeaveModal(Request $request)
    {
        return $this->sendJsonResponse($this->leaveService->addLeaveModal($request));
    }

    /**
     * Method for the Adding Leaves
     *
     * @return Body
     */
    public function confirmAddLeave(Request $request)
    {
        return $this->sendJsonResponse($this->leaveService->confirmAddLeave($request));
    }
   
    /**
     * It will return a Leave Type List
     *
     * @return Body
     */
    public function leaveType()
    {

        //$leaves = LeaveType::with('history')->get();
        $leaves_type = LeaveType::all();
        // dd($leave_type);
        return view('pages.leaveType.leave_type_list')->with('leaves_type', $leaves_type);
    }

    /**
     * It will return a HTML for the Leave Type Modal container
     *
     * @return Body
     */
    public function addLeaveTypeModal(Request $request)
    {
        return $this->sendJsonResponse($this->leaveService->addLeaveTypeModal($request));
    }

    /**
     * Method for the Adding Leaves
     *
     * @return Body
     */
    public function leaveTypeConfirmAdd(Request $request)
    {
        return $this->sendJsonResponse($this->leaveService->leaveTypeConfirmAdd($request));
    }
   /**
    * Method for Editing Leave Type on Modal PoPUP
    *
    * @return Body
    */
    public function editLeaveType(Request $request)
    {
        return $this->sendJsonResponse($this->leaveService->editLeaveType($request));
    }
    /**
    * Method for Update Leave Type 
    *
    * @return Body
    */
    public function leaveTypeUpdate(Request $request)
    {
        return $this->sendJsonResponse($this->leaveService->leaveTypeUpdate($request));   
    }

    /**
     * It will return a Approve Leave List
     *
     * @return Body
     */
    public function approveLeave()
    {
        $approve_leaves = LeaveHistory::with('type')->with('user')->get();
        return view('pages.approveLeave.approve_leave_list')->with('approve_leaves', $approve_leaves);
    }
    /**
     * It will return a HTML for the Modal container for confirmation of deletion
     *
     * @return Body
     */
    public function leaveTypeDeleteModal(Request $request)
    {
        return $this->sendJsonResponse($this->leaveService->leaveTypeDeleteModal($request));
    }
    /**
     * Method for the Deleting Users
     *
     * @return Body
     */
    public function leaveTypeDeleteConfirm(Request $request)
    {
        return $this->sendJsonResponse($this->leaveService->leaveTypeDeleteConfirm($request));
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