<?php

namespace App\Http\Controllers;

use App\Models\TechnologyStack;
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
        $project_lists = Project::where('user_id',$user_id)->get();
        return view('pages.projectManager.projectManagers')->with('project_lists', $project_lists);
    }
}
