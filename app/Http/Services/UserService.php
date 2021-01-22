<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\Menu;
use App\Models\MenuRole;
use App\Models\CheckinHistory;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    public function userReportHistory(Request $request)
    {
        $userId = $this->getAuthUserId();
        if ($request->history_report == 'Current Month') {
            $currentmonthlyCheckins = CheckinHistory::where('checkin', '>=', Carbon::now()->startOfMonth()->toDateTimeString())
                // ->where('user_id', $userId)
                ->get();
            $count = $currentmonthlyCheckins->count();
            $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $currentmonthlyCheckins, 'totalCheckins' => $count])->render();
            if ($count > 0) {
                return $this->successResponse('Current Month Checkin_History Received successfully', ['html' => $checkin_history_html, 'html_section_id' => 'self-checkin-history']);
            } else {
                return $this->errorResponse('Current Month Checkin_History Not Exists', ['errors' => ['History Not Exists'], 'html' => $checkin_history_html, 'html_section_id' => 'self-checkin-history']);
            }
        } elseif ($request->history_report == 'Previous Month') {
            //Previous Month Checkins
            $previousMonthCheckins = CheckinHistory::whereMonth(
                'checkin',
                '=',
                Carbon::now()->subMonth()->month
            )->get();
            $count = $previousMonthCheckins->count();
            $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $previousMonthCheckins, 'totalCheckins' => $count])->render();
            if ($count > 0) {
                return $this->successResponse('Previous Month Checkin_History Received successfully', ['html' => $checkin_history_html, 'html_section_id' => 'self-checkin-history']);
            } else {
                return $this->errorResponse('Previous Month Checkin_History Not Exists', ['errors' => ['History Not Exists'], 'html' => $checkin_history_html, 'html_section_id' => 'self-checkin-history']);
            }
        } elseif ($request->history_report == 'Current Week') {
            // current week
            $NowDate = Carbon::now()->format('Y-m-d');
            $currentStartWeekDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1); // gives 2016-01-3
            $currentWeekCheckins = CheckinHistory::whereBetween('checkin', array($currentStartWeekDate, $NowDate))
                // ->where('user_id', $userId)
                ->get();
            $count = $currentWeekCheckins->count();
            $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $currentWeekCheckins, 'totalCheckins' => $count])->render();
            if ($count > 0) {
                return $this->successResponse('Current Week Checkin_History Received successfully', ['html' => $checkin_history_html, 'html_section_id' => 'self-checkin-history']);
            } else {
                return $this->errorResponse('Current Week Checkin_History Not Exists', ['errors' => ['History Not Exists'], 'html' => $checkin_history_html, 'html_section_id' => 'self-checkin-history']);
            }
        } elseif ($request->history_report == 'Previous Week') {
            // Past Week Checkins (Today is not included)
            $previousWeekStartDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek - 1)->subWeek()->format('Y-m-d'); // gives 2016-01-31
            $previousWeekEndDate = Carbon::now()->subDays(Carbon::now()->dayOfWeek)->format('Y-m-d');
            $pastWeekCheckins = CheckinHistory::whereBetween('checkin', array($previousWeekStartDate, $previousWeekEndDate))
                // ->where('user_id', $userId)
                ->get();
            $count = $pastWeekCheckins->count();
            $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $pastWeekCheckins, 'totalCheckins' => $count])->render();
            if ($count > 0) {
                return $this->successResponse('Previous Week Checkin_History Received successfully', ['html' => $checkin_history_html, 'html_section_id' => 'self-checkin-history']);
            } else {
                return $this->errorResponse('Previous Week Checkin_History Not Exists', ['errors' => ['History Not Exists'], 'html' => $checkin_history_html, 'html_section_id' => 'self-checkin-history']);
            }
        } else {
            $all_checkin_history = CheckinHistory::all();
            // where('user_id', $userId)->get()
            $count = $all_checkin_history->count();
            $checkin_history_html = view('pages.user._partial._checkin_history_html', ['user_history' => $all_checkin_history, 'totalCheckins' => $count])->render();
            if ($count > 0) {
                return $this->successResponse('All Checkin_History Received successfully', ['html' => $checkin_history_html, 'html_section_id' => 'self-checkin-history']);
            } else {
                return $this->errorResponse('Checkin_History Not Exists', ['errors' => ['History Not Exists'], 'html' => $checkin_history_html, 'html_section_id' => 'self-checkin-history']);
            }
        }
    }

    public function confirmAdduser(Request $request)
    {
        ## DB operations
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('User Submittion Failed');
        }
        if (isset($request) && !empty($request)) {

            $user = User::updateOrCreate([
                'id' => $request->id,
            ], [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt('12345678'),
                'phone_number' => $request->phone_number,

            ]);

            //$user_id = $user->id; // last insert id of user
            $user->roles()->sync($request->roles); // for pivot data
            $user->save();

            $users = User::all();
        }
        $html = view('pages.user._partial._users_list_table_html', compact('users', $users))->render();
        return $this->successResponse('User has Successfully Added', ['html' => $html, 'html_section_id' => 'userlist-section']);
    }

    public function userModal(Request $request)
    {
        $user_id = $request->id;
        $user_data = User::with('roles')->find($user_id);
        //        dd(CommonUtilsFacade::isCheckIn());
        $containerId = $request->input('containerId', 'common_popup_modal');
        $roles = Role::all();
        $userRoles = [];
        if (isset($user_data->roles) && !empty($user_data->roles)) {
            foreach ($user_data->roles as $role) {
                if ($role->id > 0) {
                    $userRoles[$role->id] = $role->id;
                }
            }
        }
        $rolesDropDown = view('utils.roles', ['roles' => ($roles ?? null), 'user_roles' => $userRoles])->render();
        $html = view('pages.user._partial._add_user_modal', ['id' => $containerId, 'data' => null, 'roles_dropdown' => $rolesDropDown, 'user_data' => $user_data])->render();

        return $this->successResponse('success', ['html' => $html]);
    }

    public function userDeleteModal(Request $request)
    {
        $user_id = $request->id;
        //        dd(CommonUtilsFacade::isCheckIn());
        $containerId = $request->input('containerId', 'common_popup_modal');
        // $role_data=Role::find($user_id);
        $html = view('pages.user._partial._delete_user_modal', ['id' => $containerId, 'user_id' => $user_id])->render();

        return $this->successResponse('success', ['html' => $html]);
    }


    public function confirmDeleteUser(Request $request)
    {
        $login_id = $this->getAuthUserId();
        $user_id = $request->user_id;
        if ($user_id == $login_id) {
            return $this->errorResponse('Authorization Required', ['errors' => ['You dont have Authorization to Delete this Account']]);
        }

        $user_data = User::find($user_id);
        $user_data->delete();
        $users = User::all();
        $html = view('pages.user._partial._users_list_table_html', compact('users', $users))->render();
        return $this->successResponse('User is Successfully Deleted', ['html' => $html, 'html_section_id' => 'userlist-section']);
    }

    public function userUpdateProfile(Request $request)
    {

        if (isset($request) && !empty($request)) {

            $user_id = $this->getAuthUserId();
            $user_data = User::find($user_id);
            $user_data->first_name = $request->first_name;
            $user_data->last_name = $request->last_name;
            $user_data->email = $request->email;
            $user_data->phone_number = $request->phone_number;
            //$user_data->password = bcrypt($request->password);

            $user_data->save();
            return $this->successResponse('Profile is Successfully Updated');
        } else {

            return $this->errorResponse('Profile Updation Failed');
        }
    }

    public function userUpdatePassword(Request $request)
    {

        if (isset($request) && !empty($request)) {
            $user_id = $this->getAuthUserId();
            $user_data = User::find($user_id);
            $db_password = $user_data->password;
            $current_password = $request->current_password;
            if (Hash::check($current_password, $db_password)) {
                $new_password = $request->new_password;
                $confirm_password = $request->confirm_password;
                if ($current_password != $new_password) {
                    if ($new_password == $confirm_password) {
                        $user_data->password = bcrypt($new_password);
                        $user_data->save();
                        return $this->successResponse('Password is Successfully Updated');
                    } else {
                        return $this->errorResponse('New Password and Confirm Password Not Match', ['errors' => ['New Password and Confirm Password Not Match']]);
                    }
                } else {
                    return $this->errorResponse('New Password and Current Password Does not Same', ['errors' => ['New Password and Current Password Does not Same']]);
                }
            } else {
                return $this->errorResponse('Current Password is not correct', ['errors' => ['Current Password is not correct']]);
            }
        }
    }
}
