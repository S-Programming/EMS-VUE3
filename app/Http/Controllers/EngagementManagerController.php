<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDevelopers;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;

class EngagementManagerController extends Controller
{
//    protected $userService;
//    UserService $userService
    public function __construct()
    {
        $this->middleware('auth');
//        $this->userService = $userService;
    }
    public function assignProjectDevelopersModal(Request $request)
    {
        $project_id = $request->id;
        $developers = RoleUser::with('user')->where('role_id',5)->get();
        $developers_dropdown = view('utils.developers_dropdown', ['developers' => $developers])->render();
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.engagementManager._partial._assign_developers_modal', ['id' => $containerId,'project_id' => $project_id,'developers_dropdown'=>$developers_dropdown])->render();
        return $this->successResponse('success', ['html' => $html]);
    }
    public function confirmAssignProjectDevelopers(Request $request)
    {
        $project_id = $request->id;
        for ($i=0; $i<count($request->developers);$i=$i+1) {
            $project_developers = new ProjectDevelopers;
            $project_developers->project_id = $project_id;
            $project_developers->user_id = $request->developers[$i];
            $project_developers->save();
        }
        $project = Project::find($project_id);
        $project->working_status = 2;
//        2 when developers assign
        $project->save();
        $projects = Project::with('users')->where('working_status',"!=",2)->with('technology')->get();
        $html = view('pages.admin.projects._partial._project_list_table_html',['projects'=>$projects])->render();
        return $this->successResponse('Developers Assign Successfully',['html'=>$html,'html_section_id'=>'project-list-section']);

    }
    public function workingProjectList(Request $request)
    {
        $projects = Project::with('users')->where('working_status',2)->with('technology')->get();
        return view('pages.engagementManager.woking_projects_list',['projects'=>$projects]);
    }
}
