<?php

namespace App\Http\Controllers;

use App\Http\Services\FeedbackService;
use App\Http\Traits\AuthUser;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    use AuthUser;
    protected $feedbackService;

    public function __construct(FeedbackService $feedbackService)
    {
//        $this->middleware('auth');
        $this->feedbackService = $feedbackService;
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
    public function feedbackView(Request $request)
    {
        $feedbacks = Feedback::where('email',$this->getAuthUser()['email'])->get();
        $html = view('pages.feedback._partial._feedback_list_table_html',['html_section_id' => 'feedbacklist-section'])->render();
        return view('pages.feedback.feedback',['html'=>$html,'feedbacks' => $feedbacks]);
    }
    /**
     * Display a Modal to add feedback by User.
     *
     * @return \Illuminate\Http\Response
     */
    public function addFeedbackModal(Request $request)
    {
        return $this->sendJsonResponse($this->feedbackService->addFeedbackModal($request));
    }
    /**
     * Click yes button to add feedback confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmAddFeedbackModal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:3|max:50',
            'last_name' => 'required|string|min:3|max:50',
            'email' => 'required|email',   // |unique:users,email
            'feedback_description' => 'required',
            'feedback_status' => 'required',
            'topic' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->feedbackService->confirmAddFeedbackModal($request));
    }
    //For All users
    /**
     * View Feedbacks And Comments on Feedbacks.
     *
     * @return \Illuminate\Http\Response
     */
    public  function viewCommentsFeedback(Request $request)
    {
        //dd("sssssss");
        $feedbacks = Feedback::all();
//        dd($feedbacks);
        $html = view('pages.feedback.commentFeedback._partial._comment_feedback_overview',['html_section_id' => 'feedbacklist-section'])->render();
        return view('pages.feedback.commentFeedback.feedback',['html'=>$html,'feedbacks' => $feedbacks]);
    }
    //  Admin Admin Admin Admin Admin Admin

    //  Admin Admin Admin Admin Admin Admin

    //  Admin Admin Admin Admin Admin Admin
    /**
     * Show admin Feedback list View.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewAdminFeedback(Request $request)
    {
        $feedbacks = Feedback::all();
        $html = view('pages.admin.adminFeedback._partial._feedback_list_table_html',['html_section_id' => 'allfeedbacklist-section'])->render();
        return view('pages.admin.adminFeedback.feedback',['html'=>$html,'feedbacks' => $feedbacks]);
    }
    /**
     * Display Comment Modal for Admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCommentModal(Request $request)
    {
        return $this->sendJsonResponse($this->feedbackService->addCommentModal($request));
    }
    /**
     * Click yes button to add comment confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmAddComment(Request $request)
    {$validator = Validator::make($request->all(), [
        'admin_comment' => 'required|string|min:3|max:50',
    ]);
        if ($validator->fails()) {
            return $this->error('Validation Failed', ['errors' => $validator->errors()]);
        }
        return $this->sendJsonResponse($this->feedbackService->confirmAddComment($request));
    }
    /**
     * Display a Modal to delete Feedback.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteFeedbackModal(Request $request)
    {
        return $this->sendJsonResponse($this->feedbackService->deleteFeedbackModal($request));
    }
    /**
     * Click yes Button to delete feedback confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmDeleteFeedback(Request $request)
    {
        return $this->sendJsonResponse($this->feedbackService->confirmDeleteFeedback($request));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
