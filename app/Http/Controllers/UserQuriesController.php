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
     * Display list of Feedback To User.
     *
     * @return \Illuminate\Http\Response
     */
    public function addUserQuery(Request $request)
    {
        $user_quries = UserQuries::where('user_id',$this->getAuthUserId())->get();
        $html = view('pages.feedback._partial._feedback_list_table_html',['html_section_id' => 'feedbacklist-section'])->render();
        return view('pages.feedback.feedback',['html'=>$html,'user_quries' => $user_quries]);
    }
    /**
     * Display a Modal to add feedback by User.
     *
     * @return \Illuminate\Http\Response
     */
    public function addUserQueryModal(Request $request)
    {
        return $this->sendJsonResponse($this->userQueryService->addUserQueryModal($request));
    }
    /**
     * Click yes button to add feedback confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmAddUserQuery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic' => 'required',
            'feedback_description' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->userQueryService->confirmAddUserQuery($request));
    }
    //For All users
    /**
     * View Feedbacks And Comments on Feedbacks.
     *
     * @return \Illuminate\Http\Response
     */
    public  function viewCommentsUserQuery(Request $request)
    {
        $user_quries = UserQuries::all();
        $html = view('pages.feedback.commentFeedback._partial._comment_feedback_overview',['html_section_id' => 'feedbacklist-section'])->render();
        return view('pages.feedback.commentFeedback.feedback',['html'=>$html,'user_quries' => $user_quries]);
    }
    //  Admin Admin Admin Admin Admin Admin

    //  Admin Admin Admin Admin Admin Admin

    //  Admin Admin Admin Admin Admin Admin
    /**
     * Show admin Feedback list View.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewAdminUserQuery(Request $request)
    {
        $user_quries = UserQuries::with('users')->get();
        $html = view('pages.feedback._partial._admin_feedback_list_table_html', ['html_section_id' => 'allfeedbacklist-section'])->render();
        return view('pages.feedback.admin_feedback', ['html' => $html, 'user_quries' => $user_quries]);
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
     * Display a Modal to delete Feedback.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUserQueryModal(Request $request)
    {
        return $this->sendJsonResponse($this->userQueryService->deleteUserQueryModal($request));
    }
    /**
     * Click yes Button to delete feedback confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmDeleteUserQuery(Request $request)
    {
        return $this->sendJsonResponse($this->userQueryService->confirmDeleteUserQuery($request));
    }
}
