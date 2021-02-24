<?php

namespace App\Http\Controllers;

use App\Models\ProjectTechnologyStack;
use App\Models\TechnologyStack;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Services\ProjectManagerService;
use App\Models\User;
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
        // $user_id = $this->getAuthUserId();
        // $user_data = User::with('roles')->find($user_id);
        // dd($user_data);
        // $shop = Project::with('technology')->get();
        // dd($shop);
        // $user_id = $this->getAuthUserId();
        // $project_lists = Project::with('technology')->get();
        // dd($project_lists, 'with technology');

        $user_id = $this->getAuthUserId();
//        $project_lists = Project::where('user_id',$user_id)->get();
//        $project_lists = TechnologyStack::with('Projects')->get();
//        $project_lists = Project::with('technology')->get();
//        $project_lists = ProjectTechnologyStack::with('technologystack')->with('Project')->get();
        $project_lists = Project::with('technologystack')->with('document')->where('user_id',$user_id)->get();
//        dd($project_lists);
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
        $project_id = $request->id;
        $technologies = TechnologyStack::all();
//        $technologies = TechnologyStack::with('Projects')->get();
//        dd($technologies);
        $containerId = $request->input('containerId', 'common_popup_modal');
        $technology_stack_dropdown = view('utils.technology_stack_dropdown',['technologies'=>$technologies])->render();
        $html = view('pages.projectManager._partial._developer_request_modal',['id' => $containerId,'technology_stack_dropdown'=>$technology_stack_dropdown,'project_id'=>$project_id])->render();
        return $this->successResponse('success', ['html' => $html]);
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
        $project_technology_stack = new ProjectTechnologyStack;
        $project_technology_stack->project_id = $request->project_id;
        $project_technology_stack->technology_stack_id = $request->technology_stack_id;
        $project_technology_stack->save();
        $project = Project::find($request->project_id);
        $project->number_of_developers = $request->no_of_developers;
        $project->save();
        $user_id = $this->getAuthUserId();
        $project_lists = Project::where('user_id',$user_id)->get();
        $html = view('pages.projectManager._partial._assign_project_list_table_html', ['project_lists' => $project_lists])->render();
        return $this->successResponse('success',['html' => $html, 'html_section_id' => 'project-technology-stack-section']);

//        Carbon::parse($request->date)

    }
}
