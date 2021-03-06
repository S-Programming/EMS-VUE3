<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Services\engagementManagerService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EngagementManagerController extends Controller
{
    protected $engagementManagerService;
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
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'developers' => 'required|array|min:1',
            'developers.*' => 'required|distinct',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->engagementManagerService->confirmAssignProjectDevelopers($request));
    }
    /**
     * Display a popup modal for comments on project progress.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function commentOnProgressModal(Request $request)
    {
        return $this->sendJsonResponse($this->engagementManagerService->commentOnProgressModal($request));
    }
    /**
     * Click comment button to comment confirmly.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmCommentOnProgress(Request $request)
    {
        return $this->sendJsonResponse($this->engagementManagerService->confirmCommentOnProgress($request));
    }
}
