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
        //dd('ss');
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
//        dd($request->all());
        $validator = Validator::make($request->all(), [
            'no_of_developers' => 'required|numeric',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        $project = Project::find($request->project_id);
        $project->number_of_developers = $request->no_of_developers;
        $project->start_date = Carbon::parse($request->start_date);
        $project->end_date = Carbon::parse($request->end_date);
        $project->working_status = 1;
        $project->save();
        $user_id = $this->getAuthUserId();
        $project_lists = Project::where('user_id',$user_id)->get();
        $html = view('pages.projectManager._partial._assign_project_list_table_html', ['project_lists' => $project_lists])->render();
        return $this->successResponse('success',['html' => $html, 'html_section_id' => 'project-technology-stack-section']);
    }
}
