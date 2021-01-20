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
        $leaves = LeaveHistory::with('type')->where('user_id',$user_id)->get();
        // dd($leaves);
        return view('pages.leave.leaves_list')->with('leaves',$leaves);
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
     * Method for the Adding Users
     *
     * @return Body
     */
    public function confirmAddLeave(Request $request)
    {
        return $this->sendJsonResponse($this->leaveService->confirmAddLeave($request));
    }


    /**
     * It will return a HTML for the Modal container for confirmation of deletion
     *
     * @return Body
     */
    public function roleDeleteModal(Request $request)
    {
        return $this->sendJsonResponse($this->roleService->roleDeleteModal($request));
    }
    /**
     * Method for the Deleting Users
     *
     * @return Body
     */
    public function confirmDeleteRole(Request $request)
    {
        return $this->sendJsonResponse($this->roleService->confirmDeleteRole($request));
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
