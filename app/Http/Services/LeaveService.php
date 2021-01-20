<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\LeaveHistory;
use App\Models\LeaveStatus;
use App\Models\LeaveType;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class LeaveService extends BaseService
{
    /* All Leave Methods */
    public function confirmAddLeave(Request $request)
    {
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Leave Submittion Failed');
        }
        if (isset($request) && !empty($request)) {
            $user_id = $this->getAuthUserId();
            $leave = LeaveHistory::Create([
                'user_id' => $user_id,
                'leave_type_id' => $request->leave_types,
                'date' => $request->date,
                'description' => $request->description,

            ]);
            $leave->save();
            $leaves = LeaveHistory::with('type')->where('user_id', $user_id)->get();
            // $leaves = LeaveType::with('history')->get();
        }
        $html = view('pages.leave._partial._leaves_list_table_html', compact('leaves', $leaves))->render();
        return $this->successResponse('Leave has Successfully Added', ['html' => $html, 'html_section_id' => 'leavelist-section']);
    }

    public function addLeaveModal(Request $request)
    {
        $leave_types_data = LeaveType::all();
        $containerId = $request->input('containerId', 'common_popup_modal');
        $leave_types_dropdown = view('utils.leave_types', ['leave_types' => ($roles ?? null), 'leave_types_data' => $leave_types_data])->render();
        $html = view('pages.leave._partial._add_leave_modal', ['id' => $containerId, 'data' => null, 'leave_types_dropdown' => $leave_types_dropdown])->render();
        return $this->successResponse('success', ['html' => $html]);
    }


    /* All Leave Type Methods */
    public function addLeaveTypeModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.leaveType._partial._add_leave_type_modal', ['id' => $containerId, 'data' => null])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function leaveTypeConfirmAdd(Request $request)
    {
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Leave Type Submittion Failed');
        }
        if (isset($request) && !empty($request)) {
            $leave_type = new LeaveType();
            $leave_type->type = $request->type;
            $leave_type->save();

            $leaves_type = LeaveType::all();
        }
        $html = view('pages.leaveType._partial._leave_type_list_table_html', compact('leaves_type', $leaves_type))->render();
        return $this->successResponse('Leave Type has Successfully Added', ['html' => $html, 'html_section_id' => 'leave-type-section']);
    }

    public function editLeaveType(Request $request)
    {

        $containerId = $request->input('containerId', 'common_popup_modal');
        $leave_type_id = $request->id;
        $leave_type_data = LeaveType::find($leave_type_id);
        $html = view('pages.leaveType._partial._edit_leave_type_modal', ['id' => $containerId, 'data' => null, 'leave_type_data' => $leave_type_data])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function leaveTypeUpdate(Request $request)
    {
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Leave Type Submittion Failed');
        }
        if (isset($request) && !empty($request)) {
            $leave_type_id = $request->id;
            $leave_type = LeaveType::find($leave_type_id);
            $leave_type->type = $request->type;
            $leave_type->save();

            $leaves_type = LeaveType::all();
        }
        $html = view('pages.leaveType._partial._leave_type_list_table_html', compact('leaves_type', $leaves_type))->render();
        return $this->successResponse('Leave Type has Successfully Updated', ['html' => $html, 'html_section_id' => 'leave-type-section']);
    }

    public function leaveTypeDeleteModal(Request $request)
    {
        $leave_type_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.leaveType._partial._delete_leave_type_modal', ['id' => $containerId, 'leave_type_id' => $leave_type_id])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function leaveTypeDeleteConfirm(Request $request)
    {
        $leave_type_id = $request->leave_type_id;
        $leave_type = LeaveType::find($leave_type_id);
        $leave_type->delete();

        $leaves_type = LeaveType::all();
        $html = view('pages.leaveType._partial._leave_type_list_table_html', compact('leaves_type', $leaves_type))->render();
        return $this->successResponse('Leave Type has Successfully Deleted', ['html' => $html, 'html_section_id' => 'leave-type-section']);
    }


    /* All Leave Status Methods */
    public function addLeaveStatusModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.leaveStatus._partial._add_leave_status_modal', ['id' => $containerId, 'data' => null])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function leaveStatusConfirmAdd(Request $request)
    {
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Leave Status Submittion Failed');
        }
        if (isset($request) && !empty($request)) {
            $leave_status = new LeaveStatus();
            $leave_status->status = $request->status;
            $leave_status->save();

            $leaves_status = LeaveStatus::all();
        }
        $html = view('pages.leaveStatus._partial._leave_status_list_table_html', compact('leaves_status', $leaves_status))->render();
        return $this->successResponse('Leave Status has Successfully Added', ['html' => $html, 'html_section_id' => 'leave-status-section']);
    }

    public function editLeaveStatusModal(Request $request)
    {

        $containerId = $request->input('containerId', 'common_popup_modal');
        $leave_status_id = $request->id;
        $leave_status_data = LeaveStatus::find($leave_status_id);
        $html = view('pages.leaveStatus._partial._edit_leave_status_modal', ['id' => $containerId, 'data' => null, 'leave_status_data' => $leave_status_data])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function leaveStatusUpdate(Request $request)
    {
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Leave Status Submittion Failed');
        }
        if (isset($request) && !empty($request)) {
            $leave_status_id = $request->id;
            $leave_status = LeaveStatus::find($leave_status_id);
            $leave_status->status = $request->status;
            $leave_status->save();

            $leaves_status = LeaveStatus::all();
        }
        $html = view('pages.leaveStatus._partial._leave_status_list_table_html', compact('leaves_status', $leaves_status))->render();
        return $this->successResponse('Leave Status has Successfully Updated', ['html' => $html, 'html_section_id' => 'leave-status-section']);
    }

    public function leaveStatusDeleteModal(Request $request)
    {
        $leave_status_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.leaveStatus._partial._delete_leave_status_modal', ['id' => $containerId, 'leave_status_id' => $leave_status_id])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function leaveStatusDeleteConfirm(Request $request)
    {
        $leave_status_id = $request->leave_status_id;
        $leave_status = LeaveStatus::find($leave_status_id);
        $leave_status->delete();
        $leaves_status = LeaveStatus::all();
        $html = view('pages.leaveStatus._partial._leave_status_list_table_html', compact('leaves_status', $leaves_status))->render();
        return $this->successResponse('Leave Status has Successfully Deleted', ['html' => $html, 'html_section_id' => 'leave-status-section']);
    }
}
