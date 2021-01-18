<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\LeaveService;
use App\Models\LeaveHistory;
use App\Models\LeaveType;
use App\Models\HistoryLeaveType;

class LeaveController extends Controller
{
    protected $roleService;

    public function __construct(LeaveService $leaveService)
    {
        $this->middleware('auth');
        $this->roleService = $leaveService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('iam in leave');
        //$roles = Role::all();
        $leave_history_type = HistoryLeaveType::first();
        dd($leave_history_type->history->status);
        return view('pages.leave.leaves_list');
    }
    /**
     * It will return a HTML for the Modal container
     *
     * @return Body
     */
    public function roleModal(Request $request)
    {
        return $this->sendJsonResponse($this->roleService->roleModal($request));
    }

    /**
     * Method for the Adding Users
     *
     * @return Body
     */
    public function confirmAddRole(Request $request)
    {
        return $this->sendJsonResponse($this->roleService->confirmAddRole($request));
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
