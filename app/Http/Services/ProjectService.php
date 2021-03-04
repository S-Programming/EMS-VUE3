<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\DocumentProject;
use App\Models\Project;
use App\Models\RoleUser;
use App\Models\TechnologyStack;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProjectService extends BaseService
{
    /**
     * Display popup to add project By Admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addProjectModal(Request $request)
    {

        $technologies = TechnologyStack::all();
        $project_managers = RoleUser::with('user')->where('role_id',4)->get();
        $containerId = $request->input('containerId', 'common_popup_modal');
        $technology_stack_dropdown = view('utils.technology_stack_dropdown',['technologies'=>$technologies])->render();
        $project_managers_dropdown = view('utils.project_managers_dropdown', ['project_managers' => $project_managers])->render();
        $html = view('pages.admin.projects._partial._add_project_modal', ['id' => $containerId,'technology_stack_dropdown'=>$technology_stack_dropdown, 'data' => null, 'project_managers_dropdown' => $project_managers_dropdown])->render();
        return $this->successResponse('success', ['html' => $html]);
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

        $project = new Project;
        $project->name = $request->project_name;
        $project->description =$request->project_description;
        $project->project_manager_id =$request->project_manager_id;
        $project->save();
        for($i=0;$i<count($request->technology_stack_id);$i++)
        {
            $project->technologystack()->attach(['technology_stack_id'=>$request->technology_stack_id[$i]]);
        }
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
        $projects = Project::with('users')->orderBy('created_at', 'DESC')->get();
        $html = view('pages.admin.projects._partial._project_list_table_html',['projects'=>$projects])->render();
        return $this->successResponse('Project Added Successfully',['html'=>$html,'html_section_id'=>'project-list-section']);
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
        $project_id = $request->id;
        $project = Project::find($project_id);
        $project_manager_id = $project->project_manager_id;
        $project_managers = RoleUser::with('user')->where('role_id',\App\Http\Enums\RoleUser::ProjectManager)->get();
        $containerId = $request->input('containerId', 'common_popup_modal');
        $project_managers_dropdown = view('utils.project_managers_dropdown', ['project_managers' => $project_managers,'project_manager_id'=>$project_manager_id])->render();
        $html = view('pages.admin.projects._partial._edit_project_modal', ['id' => $containerId, 'data' => null, 'project_managers_dropdown' => $project_managers_dropdown,'project'=>$project])->render();
        return $this->successResponse('success', ['html' => $html]);
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
        $project_id = $request->id;
        $project = Project::find($project_id);
        $project->name = $request->project_name;
        $project->description =$request->project_description;
        $project->project_manager_id =$request->project_manager_id;
        $project->save();
        $projects = Project::with('users')->orderBy('created_at', 'DESC')->get();
        $html = view('pages.admin.projects._partial._project_list_table_html',['projects'=>$projects])->render();
        return $this->successResponse('Project Updated Successfully',['html'=>$html,'html_section_id'=>'project-list-section']);
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
        $project_id = $request->id;
        $project = Project::with('technologystack')->find($project_id);
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin.projects._partial._view_project_modal', ['id' => $containerId,'project'=>$project])->render();
        return $this->successResponse('success', ['html' => $html]);
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
        $project_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin.projects._partial._delete_project_modal', ['id' => $containerId, 'project_id' => $project_id])->render();
        return $this->successResponse('success', ['html' => $html]);
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
        $project = Project::find($request->project_id);
        $project->delete();
        $projects = Project::with('users')->orderBy('created_at', 'DESC')->get();
        $html = view('pages.admin.projects._partial._project_list_table_html',['projects'=>$projects])->render();
        return $this->successResponse('Project Added Successfully',['html'=>$html,'html_section_id'=>'project-list-section']);
    }
}
