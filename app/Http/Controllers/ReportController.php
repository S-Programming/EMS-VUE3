<?php

namespace App\Http\Controllers;

use App\Facades\CommonUtilsFacade;
use App\Http\Services\ReportService;
use Illuminate\Http\Request;
use App\Models\UserTaskLog;
use Illuminate\Support\Facades\Auth;
use App\Models\CheckinHistory;
use App\Models\User;
use http\Message\Body;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Session;

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
}
