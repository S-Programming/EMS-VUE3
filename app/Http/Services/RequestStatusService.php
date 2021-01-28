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
use Route\Http\Leave;

use App\Models\RequestStatus;
use Carbon\Carbon;

class RequestStatusService extends BaseService
{
    

    /* All Leave Status Methods */
    public function addStatusModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.requestStatus._partial._add_status_modal', ['id' => $containerId, 'data' => null])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function statusConfirmAdd(Request $request)
    {
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Status Submittion Failed');
        }
        if (isset($request) && !empty($request)) {
            $request_status = new RequestStatus();
            $request_status->status = $request->status;
            $request_status->save();

            $request_status = RequestStatus::all();
        }
        $html = view('pages.requestStatus._partial._request_status_list_table_html', compact('request_status', $request_status))->render();
        return $this->successResponse('Status has Successfully Added', ['html' => $html, 'html_section_id' => 'request-status-section']);
    }

    public function editStatusModal(Request $request)
    {

        $containerId = $request->input('containerId', 'common_popup_modal');
        $request_status_id = $request->id;
        $request_status = RequestStatus::find($request_status_id);
        $html = view('pages.requestStatus._partial._edit_status_modal', ['id' => $containerId, 'data' => null, 'request_status' => $request_status])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function statusUpdate(Request $request)
    {
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Status Submittion Failed');
        }
        if (isset($request) && !empty($request)) {
            $request_status_id = $request->id;
            $request_status = RequestStatus::find($request_status_id);
            $request_status->status = $request->status;
            $request_status->save();

            $request_status = RequestStatus::all();
        }
        $html = view('pages.requestStatus._partial._request_status_list_table_html', compact('request_status', $request_status))->render();
        return $this->successResponse('Status has Successfully Updated', ['html' => $html, 'html_section_id' => 'request-status-section']);
    }

    public function statusDeleteModal(Request $request)
    {
        $request_status_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.requestStatus._partial._delete_status_modal', ['id' => $containerId, 'request_status_id' => $request_status_id])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function statusDeleteConfirm(Request $request)
    {
        $request_status_id = $request->request_status_id;
        $request_status = RequestStatus::find($request_status_id);
        $request_status->delete();
        $request_status = RequestStatus::all();
        $html = view('pages.requestStatus._partial._request_status_list_table_html', compact('request_status', $request_status))->render();
        return $this->successResponse('Status has Successfully Deleted', ['html' => $html, 'html_section_id' => 'request-status-section']);
    }
   
}
