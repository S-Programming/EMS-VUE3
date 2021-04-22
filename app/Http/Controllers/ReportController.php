<?php

namespace App\Http\Controllers;

use App\Http\Services\ReportService;
use Illuminate\Http\Request;
use App\Models\UserTaskLog;
use http\Message\Body;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->middleware('auth');
        $this->reportService = $reportService;
    }

    /**
     * Report view load
     *
     * @return Body
     */
    public function index()
    {
        $userId = $this->getAuthUserId();
        $userTaskLogs = UserTaskLog::with('Project')->with('User')->where('user_id', $userId)->whereDate('created_at', Carbon::today())->get();
        $html = view('pages.report._partial._task_log_table_html')->render();
        return view('pages.report.report', ['html' => $html, 'userTaskLogs' => $userTaskLogs, 'html_section_id' => 'task-log-table-section']);
    }

    /**
     * Report Create Modal load
     *
     * @return Body
     */
    public function reportCreateModal(Request $request)
    {
        return $this->sendJsonResponse($this->reportService->reportCreateModal($request));
    }

    /**
     * Report Create
     *
     * @return Body
     */
    public function reportCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'checkin_date' => 'required',
            'hours' => 'required',
            'minutes' => 'required',
            'task_details' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->reportService->reportCreate($request));
    }

    /**
     * Report Edit Modal load
     *
     * @return Body
     */
    public function reportEditModal(Request $request)
    {
        return $this->sendJsonResponse($this->reportService->reportEditModal($request));
    }

    /**
     * Report Edit
     *
     * @return Body
     */
    public function reportEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'checkin_date' => 'required',
            'hours' => 'required',
            'minutes' => 'required',
            'task_details' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->reportService->reportEdit($request));
    }

    /**
     * Report Delete Modal load
     *
     * @return Body
     */
    public function reportDeleteModal(Request $request)
    {
        return $this->sendJsonResponse($this->reportService->reportDeleteModal($request));
    }

    /**
     * Report Delete Modal load
     *
     * @return Body
     */
    public function reportDelete(Request $request)
    {
        return $this->sendJsonResponse($this->reportService->reportDelete($request));
    }

    /**
     * Report Submit
     *
     * @return Body
     */
    public function reportSubmit(Request $request, $force = null)
    {
        $validator = Validator::make($request->all(), [
            'do_tomorrow' => 'required|max:500',   //min:3 not working
            'questions' => 'required|max:500',   //min:3 not working
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->reportService->reportSubmit($request, $force));
    }
}
