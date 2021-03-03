<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\Menu;
use App\Models\MenuRole;
use App\Models\CheckinHistory;
use App\Models\Project;
use App\Models\DevelopersProject;
use App\Models\ProjectTechnologyStack;
use App\Models\QueryStatus;
use App\Models\TechnologyStack;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Attendence;
use App\Models\DocumentProject;
use App\Models\UserInteraction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class engagementManagerService extends BaseService
{
    /**
     * Display Popup in which Engagement manager assign Developers to the Project Manager for project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assignProjectDevelopersModal(Request $request)
    {
        $project_id = $request->id;
        $developers = RoleUser::with('user')->where('role_id',5)->get();
        $developers_dropdown = view('utils.developers_dropdown', ['developers' => $developers])->render();
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.engagementManager._partial._assign_developers_modal', ['id' => $containerId,'project_id' => $project_id,'developers_dropdown'=>$developers_dropdown])->render();
        return $this->successResponse('success', ['html' => $html]);
    }
    /**
     * Engagement Manager assign developer to project Manager confirmly.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmAssignProjectDevelopers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'developers.*' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }

        $project_id = $request->id;
        for ($i=0; $i<count($request->developers);$i=$i+1) {
            $project_developers = new DevelopersProject;
            $project_developers->project_id = $project_id;
            $project_developers->user_id = $request->developers[$i];
            $project_developers->save();
        }

        $project = Project::find($project_id);
        $project->project_status = 2;
//        0 when project create and assign to project manager
//        1 when project manager requests for developers
//        2 when developers assign
        $project->save();

        $projects = Project::with('users')->where('project_status',"!=",2)->with('technologystack')->get();
        $html = view('pages.admin.projects._partial._project_list_table_html',['projects'=>$projects])->render();
        return $this->successResponse('Developers Assign Successfully',['html'=>$html,'html_section_id'=>'project-list-section']);

    }
}
