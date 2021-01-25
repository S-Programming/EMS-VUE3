<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\PublicHoliday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PublicHolidayService extends BaseService
{
    
    public function confirmAddPublicHoliday(Request $request)
    {
        ## DB operations
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Holiday Submittion Failed');
        }
        if (isset($request) && !empty($request)) {

            $holiday = new PublicHoliday;
            $holiday->date = $request->date;
            $holiday->name = $request->name;
            $holiday->save();

            $holidays = PublicHoliday::all();
        }
        $html = view('pages.admin._partial._public_holidays_list_html', compact('holidays', $holidays))->render();
        return $this->successResponse('Holiday has Successfully Added', ['html' => $html, 'html_section_id' => 'holidaylist-section']);
    }
    public function publicHolidayDeleteModal(Request $request)
    {
        $holiday_id = $request->id;
        //        dd(CommonUtilsFacade::isCheckIn());
        $containerId = $request->input('containerId', 'common_popup_modal');
        // $role_data=Role::find($user_id);
        $html = view('pages.user._partial._delete_holiday_modal', ['id' => $containerId, 'holiday_id' => $holiday_id])->render();

        return $this->successResponse('success', ['html' => $html]);
    }


    public function confirmDeletePublicHoliday(Request $request)
    {
        $holiday_id = $request->holiday_id;
     
        $holiday_data = PublicHoliday::find($holiday_id);
        $holiday_data->delete();
        $holidays = PublicHoliday::all();
        $html = view('pages.admin._partial._public_holidays_list_html', compact('holidays', $holidays))->render();
        return $this->successResponse('Holiday is Successfully Deleted', ['html' => $html, 'html_section_id' => 'holidaylist-section']);
    }

    public function publicHolidayEditModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $holiday_id = $request->id;
        $holiday_data = PublicHoliday::find($holiday_id);
        $html = view('pages.admin._partial._edit_holiday_modal', ['id' => $containerId, 'data' => null, 'holiday_data' => $holiday_data])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function publicHolidayUpdate(Request $request)
    {
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Holiday Submittion Failed');
        }
        if (isset($request) && !empty($request)) {
            $holiday_id = $request->id;
            $holiday = PublicHoliday::find($holiday_id);
            $holiday->date = $request->date;
            $holiday->name = $request->name;
            $holiday->save();

             $holidays = PublicHoliday::all();
        }
        $html = view('pages.admin._partial._public_holidays_list_html', compact('holidays', $holidays))->render();
        return $this->successResponse('Holiday has Successfully Updated', ['html' => $html, 'html_section_id' => 'holidaylist-section']);   
    }

    
}
