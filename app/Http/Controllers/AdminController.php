<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInteraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Services\AdminService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{

    protected $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->middleware('auth');
        $this->adminService = $adminService;
    }
    /**
     *
     *
     * return body
     */
    public function index()
    {
        dd("gfgfg");
    }
    public function viewUserProfilePlusInteractions(Request $request,$user_id)
    {
        $user_data = User::find($user_id);
        $user_id = $user_data->id;
        $user = User::find($this->getAuthUserId());
        $user_name = $user->first_name;
        $user_interactions = UserInteraction::with('users')->where('user_id',$user_id)->orderBy('created_at', 'DESC')->get();
        $html = view('pages.admin._partial._users_interactions_list_table_html',['html_section_id' => 'userlist-section'])->render();
        return view('pages.admin.user_profile', ['html' => $html, 'user_data' => $user_data,'user_interactions' => $user_interactions,'user_id'=>$user_id,'user_name'=>$user_name]);
    }
    /**
     * Display a popup modal to add user Interaction point.
     *
     * @return body
     */
    public function addUserInteractionModal(Request $request)
    {
        return $this->sendJsonResponse($this->adminService->addUserInteractionModal($request));
    }
    /**
     * Click ok or Yes button ro confirm to add user Interaction point.
     *
     * @return body
     */
    public function confirmAddUserInteraction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'discussion_point' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->adminService->confirmAddUserInteractionModal($request));
    }
    /**
     * Display a popup modal to delete user Interaction.
     *
     * @return body
     */
    public function deleteUserInteraction(Request $request)
    {
        return $this->sendJsonResponse($this->adminService->deleteUserInteraction($request));
    }
    /**
     * Click yes button to confirm delete user Interaction from list.
     *
     * @return body
     */
    public function deleteConfirmUserInteraction(Request $request)
    {
        return $this->sendJsonResponse($this->adminService->deleteConfirmUserInteraction($request));
    }
    /**
     * Display all user Interactions list.
     *
     * @return body
     */
    public function discussionsView(Request $request)
    {
        $current_user = $this->getAuthUserId();
        $user_interactions = UserInteraction::with('users')->where('staff_id',$current_user)->orderBy('created_at', 'DESC')->get();
        $html = view('pages.admin.discussions._partial._discussions_list',['html_section_id' => 'userlist-section'])->render();
        return view('pages.admin.discussions.discussion', ['html' => $html, 'user_interactions' => $user_interactions]);
    }
}
