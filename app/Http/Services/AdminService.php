<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\User;
use App\Models\UserInteraction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminService extends BaseService
{
    /**
     * Display a popup modal to add user Interaction point.
     *
     * @return body
     */
    public function addUserInteractionModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin._partial._add_user_interaction_point_modal',['user_id'=>$request->id])->render();
        return $this->successResponse('success', ['html' => $html]);
    }
    /**
     * Click ok or Yes button ro confirm to add user Interaction point.
     *
     * @return body
     */
    public function confirmAddUserInteractionModal(Request $request)
    {
        $user = User::find($this->getAuthUserId());
        $user_name = $user->first_name;
        $user_data = User::find($request->user_id);
        $user_interaction = new UserInteraction;
        $user_interaction->staff_id = $this->getAuthUserId();
        $user_interaction->user_id = $request->user_id;
        $user_interaction->description = $request->discussion_point;
        $user_interaction->date = Carbon::parse($request->date)??'';
        $user_interaction->save();
        $user_interactions = UserInteraction::where('user_id',$request->user_id)->orderBy('created_at', 'DESC')->get();
        $html = view('pages.admin._partial._users_interactions_list_table_html',['user_interactions' => $user_interactions,'user_name'=>$user_name,'user_id'=>$user_interaction->user_id])->render();
        return $this->successResponse('success',['html' => $html,'html_section_id' => 'userlist-section' ]);
    }
    /**
     * Display a popup modal to delete user Interaction.
     *
     * @return body
     */
    public function deleteUserInteraction(Request $request)
    {
        $ui = UserInteraction::where('id',$request->id)->first();
        $containerId = $request->input('containerId', 'common_popup_modal');
        $html = view('pages.admin.discussions._partial._delete_user_interaction_modal',['id' => $containerId, 'user_interaction_id'=>$ui->id])->render();
        return $this->successResponse('success', ['html' => $html]);
    }
    /**
     * Click yes button to confirm delete user Interaction from list.
     *
     * @return body
     */
    public function deleteConfirmUserInteraction(Request $request)
    {
        $user_interactions = UserInteraction::find($request->user_interaction_id);
        $user_interactions->delete();
        $user_id = $user_interactions->user_id;
        $user_interactions = UserInteraction::with('users')->where('user_id',$user_id)->orderBy('created_at', 'DESC')->get();
        $user = User::find($this->getAuthUserId());
        $user_name = $user->first_name;
        $html = view('pages.admin._partial._users_interactions_list_table_html',['user_interactions' => $user_interactions,'user_id'=>$user_id,'user_name'=>$user_name])->render();
        return $this->successResponse('success', ['html' => $html,'html_section_id' => 'userlist-section']);
    }
}
