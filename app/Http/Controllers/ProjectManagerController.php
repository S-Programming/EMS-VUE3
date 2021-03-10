<?php

namespace App\Http\Controllers;

use App\Http\Enums\ProjectStatus;
use App\Models\TechnologyStack;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Services\ProjectManagerService;
use App\Http\Services\ProjectService;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class ProjectManagerController extends Controller
{
    protected $projectManagerService;
    protected $projectService;

    public function __construct(ProjectManagerService $projectManagerService,ProjectService $projectService)
    {
        $this->middleware('auth');
        $this->projectManagerService = $projectManagerService;
        $this->projectService = $projectService;
    }
    /**
     * Display Assigning Project List to Project Manager.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assignProjectList()
    {
        $user_id = $this->getAuthUserId();
        $projects = $this->projectService->getProjects(['project_manager_id'=>$user_id]);
        return view('pages.projectManager.projectManagers')->with(['projects'=> $projects,'user_id'=>$user_id]);
//        $projects = Project::with('technologystack')->with('document')->where('project_manager_id',$user_id)
////        ->where('project_progress','!=','Completed')
////        ->where('project_status','<=',ProjectStatus::DevelopersRequest)
//        ->orderBy('created_at', 'DESC')->get();
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
