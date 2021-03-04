<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Services\engagementManagerService;

use Illuminate\Http\Request;

class EngagementManagerController extends Controller
{
    protected $engagementManagerService;
//    UserService $engagementManagerService
    public function __construct(engagementManagerService $engagementManagerService)
    {
        $this->middleware('auth');
        $this->engagementManagerService = $engagementManagerService;
    }
    /**
     * Display Popup in which Engagement manager assign Developers to the Project Manager for project.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assignProjectDevelopersModal(Request $request)
    {
        return $this->sendJsonResponse($this->engagementManagerService->assignProjectDevelopersModal($request));
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
        return $this->sendJsonResponse($this->engagementManagerService->confirmAssignProjectDevelopers($request));
    }

}
