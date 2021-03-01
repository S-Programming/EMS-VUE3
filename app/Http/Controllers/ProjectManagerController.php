<?php

namespace App\Http\Controllers;

use App\Models\TechnologyStack;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Services\ProjectManagerService;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class ProjectManagerController extends Controller
{
    protected $projectManagerService;

    public function __construct(ProjectManagerService $projectManagerService)
    {
        $this->middleware('auth');
        $this->projectManagerService = $projectManagerService;
    }
    /**
     * Display Assigning Project List to Project Manager.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = $this->getAuthUserId();
        $project_lists = Project::with('technologystack')->with('document')->where('user_id',$user_id)->get();
        return view('pages.projectManager.projectManagers')->with('project_lists', $project_lists);
    }
    /**
     * Display Developer Request Modal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function developersRequestModal(Request $request)
    {
        return $this->sendJsonResponse($this->projectManagerService->developersRequestModal($request));

    }
    /**
     * Project Manager Request for Developer Request by using send button.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDevelopersRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_of_developers' => 'required|numeric',
            'start_date' => 'required|date',
            'project_manager_description' => 'required',
            'estimate_time' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->projectManagerService->confirmDevelopersRequest($request));
    }
}