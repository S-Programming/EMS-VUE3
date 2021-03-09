<?php


namespace App\Http\Services;


use App\Http\Enums\ProjectStatus;
use App\Http\Services\BaseService\BaseService;
use App\Models\DevelopersProject;
use App\Models\Project;
use App\Models\User;
use App\Models\TechnologyStack;
use App\Models\RoleUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectManagerService extends BaseService
{
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
        $project = Project::find($request->project_id);
        $project->number_of_developers = $request->no_of_developers;
        $project->pm_description = $request->project_manager_description;
        $project->start_date = Carbon::parse($request->start_date);
        $project->estimate_time = $request->estimate_time;
        $project->project_status = ProjectStatus::DevelopersRequest;
        $project->save();
        $project_manager_id = $this->getAuthUserId();
        $project_lists = Project::where('project_status','<=',ProjectStatus::DevelopersRequest)
            ->where('project_manager_id',$project_manager_id)
            ->orderBy('created_at', 'DESC')->get();
        $html = view('pages.projectManager._partial._assign_project_list_table_html', ['project_lists' => $project_lists])->render();
        return $this->successResponse('success',['html' => $html, 'html_section_id' => 'pm-project-section']);
    }
    /**
     * Working Projects List of Project Manager.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function workingProjectsList(Request $request)
    {
        $user_id = $this->getAuthUserId();
//        $sadd = Project::with('users')->where('project_manager_id', $user_id)->get();
//        dd($sadd->users);
        if($user_id == \App\Http\Enums\RoleUser::ProjectManager) {
            $project_lists = Project::with('technologystack')->with('document')->where('project_manager_id', $user_id)
                ->where('project_status', ProjectStatus::WORKING_PROJECT)
//                ->where('project_progress', '!=', 'Completed')
                ->orderBy('created_at', 'DESC')->get();
//            dd($project_lists);
            $html = view('pages.projectManager._partial._working_project_list_table_html', ['project_lists' => $project_lists])->render();
            return $this->successResponse('Working Projects', ['html' => $html, 'html_section_id' => 'pm-project-section']);
        }elseif($user_id == \App\Http\Enums\RoleUser::EngagementManager)
        {
            $working_projects = Project::with('technologystack')->with('document')
                ->where('project_status', ProjectStatus::WORKING_PROJECT)
                ->orderBy('created_at', 'DESC')->get();
            $html = view('pages.engagementManager._partial._working_projects_list_table_html', ['projects' => $working_projects])->render();
            return $this->successResponse('Working Projects', ['html' => $html, 'html_section_id' => 'project-list-section']);
        }
    }
    /**
     * Display popup for working project status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function workingProjectStatusModal(Request $request)
    {
        $project_id = $request->id;
        $project = Project::find($project_id);
        $project_progress = $project->project_progress;
//        dd($project_progress);
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.projectManager._partial._project_status_modal',['id' => $containerId,'project_id'=>$project_id,'project_progress'=>$project_progress])->render();
        return $this->successResponse('success', ['html' => $html]);


    }
    /**
     * Click update for working project status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmWorkingProjectStatus(Request $request)
    {
        $project_id = $request->id;
        $project = Project::find($project_id);

        $project->project_progress = $request->project_completion_status;
        if($project->project_progress == '100%'){
            $project->project_status = 5;
        } else{
            $project->project_status = 2;
        }
        $project->save();
        $project_manager_id = $this->getAuthUserId();
        $working_projects = Project::with('technologystack')->with('document')->where('project_manager_id',$project_manager_id)
        ->where('project_status',ProjectStatus::WORKING_PROJECT)
        ->where('project_progress','!=','Completed')
        ->orderBy('created_at', 'DESC')->get();
        $project_manager_id = $this->getAuthUserId();
        $html = view('pages.projectManager._partial._working_project_list_table_html',['project_lists'=>$working_projects])->render();
//        ,'user_id'=>$project_manager_id
        return $this->successResponse('Working Projects',['html'=>$html,'html_section_id'=>'pm-project-section']);
//        dd('project ka status update kro g');

    }
    /**
     * Completed Projects List of Project Manager.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function completedProjectsList(Request $request)
    {
        $user_id = $this->getAuthUserId();
        if($user_id == \App\Http\Enums\RoleUser::ProjectManager){
//            dd('PM');
            $working_projects = Project::with('technologystack')->with('document')->where('project_manager_id',\App\Http\Enums\RoleUser::ProjectManager)
//                ->where('project_status',ProjectStatus::WORKING_PROJECT)
                ->where('project_progress','=','100%')
                ->orderBy('created_at', 'DESC')->get();
//            dd($working_projects);
            $html = view('pages.projectManager._partial._working_project_list_table_html',['project_lists'=>$working_projects])->render();
            return $this->successResponse('Working Projects',['html'=>$html,'html_section_id'=>'pm-project-section']);
        }elseif($user_id == \App\Http\Enums\RoleUser::EngagementManager)
        {
            $projects = Project::with('technologystack')->with('document')
                ->where('project_progress','=','100%')
                ->orderBy('created_at', 'DESC')->get();
            $html = view('pages.admin.projects._partial._project_list_table_html',['projects'=>$projects])->render();
            return $this->successResponse('Project Added Successfully',['html'=>$html,'html_section_id'=>'project-list-section']);
        }

    }
}
