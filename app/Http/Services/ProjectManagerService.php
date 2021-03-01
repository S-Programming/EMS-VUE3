<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
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
        $project->project_status = 1;
        $project->save();
        $user_id = $this->getAuthUserId();
        $project_lists = Project::where('user_id',$user_id)->get();
        $html = view('pages.projectManager._partial._assign_project_list_table_html', ['project_lists' => $project_lists])->render();
        return $this->successResponse('success',['html' => $html, 'html_section_id' => 'project-technology-stack-section']);
    }
}
