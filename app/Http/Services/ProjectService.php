<?php


namespace App\Http\Services;


use App\Http\Enums\ProjectStatus;
use App\Http\Services\BaseService\BaseService;
use App\Models\DevelopersProject;
use App\Models\DocumentProject;
use App\Models\Project;
use App\Models\ProjectTechnologyStack;
use App\Models\RoleUser;
use App\Models\TechnologyStack;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectService extends BaseService
{

    public function getProjects($filters = [])
    {
        $projects = Project::with('users', 'technologystack','developers');
        if (isset($filters) && !empty($filters)) {
            $projects = $projects->where($filters);
        }

        $projects = $projects->orderBy('created_at', 'DESC')->get();
        return $projects;

     /*   if (isset($filers['project_status']) && trim($filers['project_status'])!='') {
            $projects = $projects->where('project_status',$filers['project_status']);
        }
        if (isset($filers['first_name']) &&$filers['first_name']==1) {
            $projects = $projects->where('first_name',$filers['first_name']);
        }*/
    }
    public function getProjectById($id = 0)
    {
        if(isset($id) && trim($id != '')){
            $project = Project::find($id);
            return $project;
        }
        return $project??'';
//        $projects = $this->getProjects(['id'=>$id]);
//        return $projects;
    }

    /**
     * Display all projects list with project Managers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function projectList(Request $request,$filter)
    {

            if($filter == ProjectStatus::WORKING_PROJECT){
                $projects = $this->getProjects(['project_status'=>ProjectStatus::WORKING_PROJECT]);
                $html = view('pages.engagementManager._partial._working_projects_list_table_html', ['projects' => $projects])->render();
                return $this->successResponse('Working Projects', ['html' => $html,'projects'=>$projects,'html_section_id' => 'project-list-section']);
            }elseif ($filter == ProjectStatus::COMPLETED_PROJECT){
                $projects = $this->getProjects(['project_status'=>ProjectStatus::COMPLETED_PROJECT]);
                $html = view('pages.engagementManager._partial._working_projects_list_table_html',['projects'=>$projects])->render();
//                $html = view('pages.admin.projects._partial._project_list_table_html',['projects'=>$projects])->render();
                return $this->successResponse('Completed Projects!',['html'=>$html,'html_section_id'=>'project-list-section']);
            }elseif ($filter == "10"){
                $projects = $this->getProjects();
                $html = view('pages.admin.projects._partial._project_list_table_html',['projects' => $projects])->render();
                return $this->successResponse('All Projects!',['html'=>$html,'html_section_id'=>'project-list-section']);
            }
    }
    /**
     * Display popup to add project By Admin.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function addProjectModal(Request $request)
    {

        $technologies = TechnologyStack::all();
        $project_managers = RoleUser::with('user')->where('role_id', 4)->get();
        $containerId = $request->input('containerId', 'common_popup_modal');
        $technology_stack_dropdown = view('utils.technology_stack_dropdown', ['technologies' => $technologies])->render();
        $project_managers_dropdown = view('utils.project_managers_dropdown', ['project_managers' => $project_managers])->render();
        $html = view('pages.admin.projects._partial._add_project_modal', ['id' => $containerId, 'technology_stack_dropdown' => $technology_stack_dropdown, 'data' => null, 'project_managers_dropdown' => $project_managers_dropdown])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    /**
     * Click Add to add project in the project list.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function confirmAddProject(Request $request)
    {

        $project = new Project;
        $project->name = $request->project_name;
        $project->description = $request->project_description;
        $project->project_manager_id = $request->project_manager_id;
        $project->save();
        $project->technologystack()->attach($request->technology_stack_id);
        $project_id = $project->id;
        $file = $request->file('project_document');
        $file_name = $file->getClientOriginalName();
        $destination_path = 'uploads/files';
        $file_path = $destination_path . "/" . $file_name;
        $file->move($destination_path, $file->getClientOriginalName());
        $project_document = new DocumentProject;
        $project_document->path = $file_name;
        $project_document->project_id = $project_id;
        $project_document->save();
//        $projects = Project::with('users')->where('project_status', '<', ProjectStatus::WORKING_PROJECT)->orderBy('created_at', 'DESC')->get();
        $projects = $this->getProjects();
        $html = view('pages.admin.projects._partial._project_list_table_html', ['projects' => $projects])->render();
        return $this->successResponse('Project Added Successfully', ['html' => $html, 'html_section_id' => 'project-list-section']);
    }

    /**
     * Display popup to edit Project Attributes.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function editProjectModal(Request $request)
    {
//        $project_id = $request->id;
        $technologies = TechnologyStack::all();
//        $project = Project::find($project_id);
        $project = $this->getProjectById($request->id);
        $project_manager_id = $project->project_manager_id;
        $project_manager_data = User::where('id', $project_manager_id)->get();
        $project_manager_name = $project_manager_data->first()->first_name;
        $projectTechnologies = [];
        $project_managers = RoleUser::with('user')->where('role_id', \App\Http\Enums\RoleUser::ProjectManager)->get();

        if (isset($project->technologystack) && !empty($project->technologystack)) {
            foreach ($project->technologystack as $data) {
                if ($data->id > 0) {
                    $projectTechnologies[$data->id] = $data->id;
                }
            }
        }
        $containerId = $request->input('containerId', 'common_popup_modal');
        $technology_stack_dropdown = view('utils.technology_stack_dropdown', ['technologies' => ($technologies ?? null), 'projectTechnologies' => $projectTechnologies])->render();
        $project_managers_dropdown = view('utils.project_managers_dropdown', ['project_managers' => $project_managers, 'project_manager_name' => $project_manager_name])->render();
        $html = view('pages.admin.projects._partial._edit_project_modal', ['id' => $containerId, 'technology_stack_dropdown' => $technology_stack_dropdown, 'data' => null, 'project_managers_dropdown' => $project_managers_dropdown, 'project' => $project])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    /**
     * Click Update Button to edit Project Attributes.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function confirmEditProjectModal(Request $request)
    {
        //  dd($request->technology_stack_id);
//        $project_id = $request->id;
//        $project = Project::find($project_id);
        $project = $this->getProjectById($request->id);
        $project->name = $request->project_name;
        $project->description = $request->project_description;
        $project->project_manager_id = $request->project_manager_id;
        $project->save();
        $project->technologystack()->sync($request->technology_stack_id);
//        $projects = Project::with('users')->where('project_status', '<', ProjectStatus::WORKING_PROJECT)->orderBy('created_at', 'DESC')->get();
        $projects = $this->getProjects();
        $html = view('pages.admin.projects._partial._project_list_table_html', ['projects' => $projects])->render();
        return $this->successResponse('Project Updated Successfully', ['html' => $html, 'html_section_id' => 'project-list-section']);
    }

    /**
     * Display popup to view the Project with detail.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function viewProjectModal(Request $request)
    {
        $project_id = $request->id;
        $project = Project::with('technologystack')->find($project_id);
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin.projects._partial._view_project_modal', ['id' => $containerId, 'project' => $project])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    /**
     * Display Popup to delete Project form DB.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProjectModal(Request $request)
    {
        $project_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin.projects._partial._delete_project_modal', ['id' => $containerId, 'project_id' => $project_id])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    /**
     * Click Delete button to delete project from DB.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function confirmDeleteProjectModal(Request $request)
    {
        $project = $this->getProjectById($request->project_id);
        $project->delete();
        $projects = $this->getProjects();
        $html = view('pages.admin.projects._partial._project_list_table_html', ['projects' => $projects])->render();
        return $this->successResponse('Project Deleted Successfully', ['html' => $html, 'html_section_id' => 'project-list-section']);
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
//        $project_data = Project::where('project_manager_id', $user_id)->with('developers')->get();
        if($user_id == \App\Http\Enums\RoleUser::ProjectManager) {
            $projects = $this->getProjects(['project_manager_id'=>$user_id,'project_status'=>ProjectStatus::WORKING_PROJECT]);
//            $proje = DevelopersProject::with('users')->get();
//            dd($proje);
//            $developer_user = DevelopersProject::with('users')->get();
            dd($projects[0]->developers);
            $html = view('pages.projectManager._partial._working_project_list_table_html', ['projects' => $projects])->render();
            return $this->successResponse('Working Projects', ['html' => $html, 'html_section_id' => 'pm-project-section']);
        }elseif($user_id == \App\Http\Enums\RoleUser::EngagementManager)
        {
            $projects = $this->getProjects(['project_status'=>ProjectStatus::WORKING_PROJECT]);
            $html = view('pages.engagementManager._partial._working_projects_list_table_html', ['projects' => $projects])->render();
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
//        $project = Project::find($project_id);
        $project = $this->getProjectById($project_id);
        $project_progress = $project->project_progress;
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
        $projects = $this->getProjects(['project_manager_id'=>$project_manager_id,'project_status'=>ProjectStatus::WORKING_PROJECT]);
        $html = view('pages.projectManager._partial._working_project_list_table_html',['projects'=>$projects])->render();
        return $this->successResponse('Working Projects',['html'=>$html,'html_section_id'=>'pm-project-section']);

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
            $projects = $this->getProjects(['project_manager_id'=>\App\Http\Enums\RoleUser::ProjectManager,'project_status'=>ProjectStatus::COMPLETED_PROJECT]);
            $html = view('pages.projectManager._partial._working_project_list_table_html',['projects'=>$projects])->render();
            return $this->successResponse('Completed Projects!',['html'=>$html,'html_section_id'=>'pm-project-section']);
        }elseif($user_id == \App\Http\Enums\RoleUser::EngagementManager)
        {
            $projects = $this->getProjects(['project_status'=>ProjectStatus::COMPLETED_PROJECT]);
            $html = view('pages.admin.projects._partial._project_list_table_html',['projects'=>$projects])->render();
            return $this->successResponse('Completed Projects!',['html'=>$html,'html_section_id'=>'project-list-section']);
        }

    }

}
