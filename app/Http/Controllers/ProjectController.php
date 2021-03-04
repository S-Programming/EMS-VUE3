<?php

namespace App\Http\Controllers;

use App\Http\Enums\ProjectStatus;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Services\ProjectService;

use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    protected $projectService;
    public function __construct(ProjectService $projectService)
    {
        $this->middleware('auth');
        $this->projectService = $projectService;
    }
    /**
     * Display all projects list with project Managers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function projectList(Request $request)
    {
        $projects = Project::with('users')->with('technologystack')->where('project_status',"!=",ProjectStatus::WorkingProject)->orderBy('created_at', 'DESC')->get();
        return view('pages.admin.projects.projects',['projects'=>$projects]);
    }
    /**
     * Display popup to add project By Admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addProjectModal(Request $request)
    {
        return $this->sendJsonResponse($this->projectService->addProjectModal($request));
    }
    /**
     * Click Add to add project in the project list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmAddProject(Request $request)
    {
//        dd($request->all());
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|min:3|string',
            'project_description' => 'required|min:3',
            'project_manager_id' => 'required|numeric',
            'technology_stack_id.*' => 'required|distinct|numeric|min:1',
//            'project_document' => 'required|csv,txt,xlx,xls,pdf|max:2048',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->projectService->confirmAddProject($request));
    }
    /**
     * Display popup to edit Project Attributes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProjectModal(Request $request)
    {
        return $this->sendJsonResponse($this->projectService->editProjectModal($request));
    }
    /**
     * Click Update Button to edit Project Attributes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmEditProjectModal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|min:3|max:30',
            'project_description' => 'required|min:3|max:500',
            'project_manager_id' => 'required|numeric',
//            'date' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->projectService->confirmEditProjectModal($request));
    }
    /**
     * Display popup to view the Project with detail.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewProjectModal(Request $request)
    {
        return $this->sendJsonResponse($this->projectService->viewProjectModal($request));
    }
    /**
     * Display Popup to delete Project form DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProjectModal(Request $request)
    {
        return $this->sendJsonResponse($this->projectService->deleteProjectModal($request));
    }
    /**
     * Click Delete button to delete project from DB.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDeleteProjectModal(Request $request)
    {
        return $this->sendJsonResponse($this->projectService->confirmDeleteProjectModal($request));
    }
    /**
     * Display view for working project list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function workingProjectList(Request $request)
    {
        $projects = Project::with('users')->where('project_status',ProjectStatus::WorkingProject)->with('technologystack')->orderBy('created_at','DESC')->get();
        return view('pages.engagementManager.woking_projects_list',['projects'=>$projects]);
    }
}
