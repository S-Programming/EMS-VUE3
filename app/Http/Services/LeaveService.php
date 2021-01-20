<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\LeaveHistory;
use App\Models\LeaveType;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class LeaveService extends BaseService
{
    public function confirmAddLeave(Request $request)
    {
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('User Submittion Failed');
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
            $leaves = LeaveHistory::with('type')->where('user_id',$user_id)->get();
            // $leaves = LeaveType::with('history')->get();
        }
        $html = view('pages.leave._partial._leaves_list_table_html', compact('leaves', $leaves))->render();
        return $this->successResponse('Role has Successfully Added', ['html' => $html, 'html_section_id' => 'userlist-section']);
    }

    public function addLeaveModal(Request $request)
    {
        $leave_types_data = LeaveType::all();
        $containerId = $request->input('containerId', 'common_popup_modal');
        $leave_types_dropdown = view('utils.leave_types', ['leave_types' => ($roles ?? null), 'leave_types_data' => $leave_types_data])->render();
        $html = view('pages.leave._partial._add_leave_modal', ['id' => $containerId, 'data' => null, 'leave_types_dropdown' => $leave_types_dropdown])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function addLeaveTypeModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.leaveType._partial._add_leave_type_modal', ['id' => $containerId, 'data' => null])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function leaveTypeConfirmAdd(Request $request)
    {
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('User Submittion Failed');
        }
        if (isset($request) && !empty($request)) {
            $leave_type = new LeaveType();
            $leave_type->type = $request->type;
            $leave_type->save();
            // $user_id = $this->getAuthUserId();
            // $leave = LeaveHistory::Create([
            //     'user_id' => $user_id,
            //     'leave_type_id' => $request->leave_types,
            //     'date' => $request->date,
            //     'description' => $request->description,

            // ]);
            // $leave->save();
            // $leaves = LeaveType::with('history')->get();
            $leaves_type = LeaveType::all();
        }
        $html = view('pages.leaveType._partial._leave_type_list_table_html', compact('leaves_type', $leaves_type))->render();
        return $this->successResponse('Leave Type has Successfully Added', ['html' => $html, 'html_section_id' => 'userlist-section']);
    }

    public function roleDeleteModal(Request $request)
    {
        $role_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.role._partial._delete_role_modal', ['id' => $containerId, 'role_id' => $role_id])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function confirmDeleteRole(Request $request)
    {
        $login_id = $this->getAuthUserId();
        $role_id = $request->id;
        if ($role_id == $login_id) {
            return $this->errorResponse('You dont have Authorization to Delete this Role');
        }

        $role_data = Role::find($role_id);
        $role_data->delete();
        $roles = Role::all();
        $html = view('pages.role._partial._datatable_html', compact('roles', $roles))->render();
        return $this->successResponse('Role is Successfully Deleted', ['html' => $html]);
    }
}
