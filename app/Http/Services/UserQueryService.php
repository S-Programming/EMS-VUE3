<?php


namespace App\Http\Services;
use App\Models\QueryStatus;
use App\Models\UserQuries;
use App\Http\Traits\AuthUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Services\BaseService\BaseService;
use Illuminate\Support\Facades\Hash;

class UserQueryService extends BaseService
{
    use AuthUser;
    /**
     * Display a Modal to add user_query by User.
     *
     * @return \Illuminate\Http\Response
     */
    public function addUserQueryModal(Request $request)
    {
        $user_email = $this->getAuthUser()['email'];
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.user_query._partial._add_user_query_modal',['user_email'=>$user_email])->render();
        return $this->successResponse('success', ['html' => $html]);
    }
    /**
     * Click yes button to add user_query confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmAddUserQuery(Request $request)
    {
        $user_qurie = new UserQuries;
        $user_qurie->user_id =$this->getAuthUserId();
        $user_qurie->description = $request->user_query_description;
        $user_qurie->topic =$request->topic;
        $user_qurie->save();
        $user_quries = UserQuries::where('user_id',$this->getAuthUserId())->get();
        $html = view('pages.user_query._partial._user_query_list_table_html',['user_quries'=>$user_quries])->render();
        return $this->successResponse('success', ['html' => $html, 'html_section_id' => 'user-query-list-section']);
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
        $query_statuses = QueryStatus::all();
        $user_qurie_id = $request->id;
        $user_quries = UserQuries::find($user_qurie_id);
        $containerId = $request->input('containerId', 'common_popup_modal');
        $query_status_menu_html = view('utils._partial._query_status_menu',['query_statuses'=>$query_statuses])->render();
        $html = view('pages.user_query._partial._add_comment_modal',['id' => $containerId,'query_status_menu_html'=>$query_status_menu_html,'user_qurie_id'=>$user_qurie_id,'user_quries' => $user_quries])->render();
        return $this->successResponse('success', ['html' => $html]);
    }
    /**
     * Click yes button to add comment confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmAddComment(Request $request)
    {
        $user_query_id = $request->user_query_id;
        $user_qurie = UserQuries::where('id',$user_query_id)->first();
        $user_qurie->comment = $request->admin_comment;
        $user_qurie->query_status_id = $request->status;
        $user_qurie->is_view = "viewed";
        $user_qurie->save();
        $user_quries = UserQuries::all();
        $html = view('pages.user_query._partial._admin_user_query_list_table_html', ['user_quries' => $user_quries])->render();
        return $this->successResponse('success',['html' => $html, 'html_section_id' => 'user-query-list-section']);
    }
    /**
     * Display a Modal to delete user_query.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUserQueryModal(Request $request)
    {
        $user_qurie_id = $request->id;
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.user_query._partial._delete_user_query_modal', ['id' => $containerId, 'user_qurie_id' => $user_qurie_id])->render();
        return $this->successResponse('success', ['html' => $html]);
    }
    /**
     * Click yes Button to delete user_query confirmly.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmDeleteUserQuery(Request $request)
    {
        $user_qurie_id = $request->user_qurie_id;
        $user_qurie_to_delete = UserQuries::where('id',$user_qurie_id)->first();
        $user_qurie_to_delete->delete();
        $user_quries = UserQuries::all();
        $html = view('pages.user_query._partial._admin_user_query_list_table_html',['user_quries'=>$user_quries])->render();
        return $this->successResponse('success', ['html' => $html, 'html_section_id' => 'user-query-list-section']);
    }
}
