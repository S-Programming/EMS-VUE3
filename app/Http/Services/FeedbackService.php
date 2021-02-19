<?php


namespace App\Http\Services;

use App\Models\Feedback;
use App\Http\Traits\AuthUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Services\BaseService\BaseService;
use Illuminate\Support\Facades\Hash;

class FeedbackService extends BaseService
{
    use AuthUser;
    /**
     * Display a Modal to add feedback by User.
     *
     * @return \Illuminate\Http\Response
     */
    public function addFeedbackModal(Request $request)
    {
        $user_email = $this->getAuthUser()['email'];
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.feedback._partial._add_feedback_modal',['user_email'=>$user_email])->render();
        return $this->successResponse('success', ['html' => $html]);
    }
    /**
     * Click yes button to add feedback confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmAddFeedbackModal(Request $request)
    {
        $feedback = new Feedback;
        $feedback->first_name = $request->first_name;
        $feedback->last_name = $request->last_name;
        $feedback->email = $request->email;
        $feedback->description = $request->feedback_description;
        $feedback->rate_status =$request->feedback_status;
        $feedback->topic =$request->topic;
        $feedback->save();
        $feedbacks = Feedback::where('email',$this->getAuthUser()['email'])->get();
        $html = view('pages.feedback._partial._feedback_list_table_html',['feedbacks'=>$feedbacks])->render();
        return $this->successResponse('success', ['html' => $html, 'html_section_id' => 'feedbacklist-section']);
    }
    /**
     * Admin Admin Admin Admin Admin
     * Admin Admin Admin Admin Admin
     * Admin Admin Admin Admin Admin
     *
     * Display Comment Modal for Admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function addCommentModal(Request $request)
    {
        $feedback_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin.adminFeedback._partial._add_comment_modal',['feedback_id'=>$feedback_id])->render();
        return $this->successResponse('success', ['html' => $html]);
    }
    /**
     * Click yes button to add comment confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmAddComment(Request $request)
    {
        $feedback = Feedback::find($request->feedback_id);
        $feedback->admin_comment = $request->admin_comment;
        $feedback->is_view = "viewed";
        $feedback->save();
        $feedbacks = Feedback::all();
        $html = view('pages.admin.adminFeedback._partial._feedback_list_table_html',['feedbacks' => $feedbacks])->render();
        return $this->successResponse('success', ['html' => $html, 'html_section_id' => 'feedbacklist-section']);
    }
    /**
     * Display a Modal to delete Feedback.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteFeedbackModal(Request $request)
    {
        $feedback_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin.adminFeedback._partial._delete_feedback_modal', ['id' => $containerId, 'feedback_id' => $feedback_id])->render();
        return $this->successResponse('success', ['html' => $html]);
    }
    /**
     * Click yes Button to delete feedback confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmDeleteFeedback(Request $request)
    {
        $feedback_id = $request->feedback_id;
//        dd($feedback_id);
//        $feddback_to_delete = Feedback::find($feedback_id)->first();
        $feddback_to_delete = Feedback::where('id',$feedback_id)->first();
        $feddback_to_delete->delete();
        $feedbacks = Feedback::all();
        $html = view('pages.admin.adminFeedback._partial._feedback_list_table_html',['feedbacks'=>$feedbacks])->render();
        return $this->successResponse('success', ['html' => $html, 'html_section_id' => 'feedbacklist-section']);
    }
}
