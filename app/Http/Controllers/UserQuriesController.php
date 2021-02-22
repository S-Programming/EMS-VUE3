<?php

namespace App\Http\Controllers;

use App\Http\Services\UserQueryService;
use App\Http\Traits\AuthUser;
use App\Models\QueryStatus;
use App\Models\UserQuries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserQuriesController extends Controller
{
    use AuthUser;
    protected $userQueryService;

    public function __construct(UserQueryService $userQueryService)
    {
//        $this->middleware('auth');
        $this->userQueryService = $userQueryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Display list of user_query To User.
     *
     * @return \Illuminate\Http\Response
     */
    public function addUserQuery(Request $request)
    {
        $user_quries = UserQuries::where('user_id',$this->getAuthUserId())->get();
        $html = view('pages.user_query._partial._user_query_list_table_html',['html_section_id' => 'user-query-list-section'])->render();
        return view('pages.user_query.user_query',['html'=>$html,'user_quries' => $user_quries]);
    }
    /**
     * Display a Modal to add user_query by User.
     *
     * @return \Illuminate\Http\Response
     */
    public function addUserQueryModal(Request $request)
    {
        return $this->sendJsonResponse($this->userQueryService->addUserQueryModal($request));
    }
    /**
     * Click yes button to add user_query confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmAddUserQuery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic' => 'required',
            'user_query_description' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->userQueryService->confirmAddUserQuery($request));
    }
    //For All users
    /**
     * View user_queries And Comments on user_query.
     *
     * @return \Illuminate\Http\Response
     */
    public  function viewCommentsUserQuery(Request $request)
    {

        $user_quries = UserQuries::all();
        $html = view('pages.user_query._partial._comment_user_query_overview',['html_section_id' => 'user-query-list-section'])->render();
        return view('pages.user_query.user_query',['html'=>$html,'user_quries' => $user_quries]);
    }


    /**
     *
     * Admin Admin Admin Admin Admin Admin
     *
     * Show admin user_query list View.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewAdminUserQuery(Request $request)
    {
        $user_quries = UserQuries::with('users')->get();
        $html = view('pages.user_query._partial._admin_user_query_list_table_html', ['html_section_id' => 'user-query-list-section'])->render();
        return view('pages.user_query.admin_user_query', ['html' => $html, 'user_quries' => $user_quries]);
    }
    /**
     * Display Comment Modal for Admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCommentModal(Request $request)
    {
        return $this->sendJsonResponse($this->userQueryService->addCommentModal($request));
    }
    /**
     * Click yes button to add comment confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmAddComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_comment' => 'required|string',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->userQueryService->confirmAddComment($request));
    }
    /**
     * Display a Modal to delete user_query.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUserQueryModal(Request $request)
    {
        return $this->sendJsonResponse($this->userQueryService->deleteUserQueryModal($request));
    }
    /**
     * Click yes Button to delete user_query confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmDeleteUserQuery(Request $request)
    {
        return $this->sendJsonResponse($this->userQueryService->confirmDeleteUserQuery($request));
    }
}
