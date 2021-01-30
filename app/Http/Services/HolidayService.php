<?php


namespace App\Http\Services;


use App\Http\Services\BaseService\BaseService;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HolidayService extends BaseService
{
    
    public function confirmAddHoliday(Request $request)
    {
        ## DB operations
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Holiday Submittion Failed');
        }
        if (isset($request) && !empty($request)) {

            $holiday = new Holiday;
            if($request->date_range !='')
            {
                $date_range = explode('to',$request->date_range);
            
                $holiday->start_date = Carbon::parse($date_range[0]);
                $holiday->end_date = Carbon::parse($date_range[1]) ?? '';
            }
            else
            {
                $holiday->start_date = Carbon::parse($request->date);
            }
            $holiday->name = $request->name;
            $holiday->save();

            $holidays = Holiday::all();
        }
        $html = view('pages.admin._partial._holidays_list_html', compact('holidays', $holidays))->render();
        return $this->successResponse('Holiday has Successfully Added', ['html' => $html, 'html_section_id' => 'holidaylist-section']);
    }
    public function holidayDeleteModal(Request $request)
    {
        $holiday_id = $request->id;
        //        dd(CommonUtilsFacade::isCheckIn());
        $containerId = $request->input('containerId', 'common_popup_modal');
        // $role_data=Role::find($user_id);
        $html = view('pages.admin._partial._delete_holiday_modal', ['id' => $containerId, 'holiday_id' => $holiday_id])->render();

        return $this->successResponse('success', ['html' => $html]);
    }


    public function confirmDeleteHoliday(Request $request)
    {
        $holiday_id = $request->holiday_id;
     
        $holiday_data = Holiday::find($holiday_id);
        $holiday_data->delete();
        $holidays = Holiday::all();
        $html = view('pages.admin._partial._holidays_list_html', compact('holidays', $holidays))->render();
        return $this->successResponse('Holiday is Successfully Deleted', ['html' => $html, 'html_section_id' => 'holidaylist-section']);
    }

    public function holidayEditModal(Request $request)
    {
        $containerId = $request->input('containerId', 'common_popup_modal');
        $holiday_id = $request->id;
        $holiday_data = Holiday::find($holiday_id);
        $html = view('pages.admin._partial._edit_holiday_modal', ['id' => $containerId, 'data' => null, 'holiday_data' => $holiday_data])->render();
        return $this->successResponse('success', ['html' => $html]);
    }

    public function holidayUpdate(Request $request)
    {
        if (!isset($request) && empty($request)) { // what will be condition
            return $this->errorResponse('Holiday Submittion Failed');
        }
        if (isset($request) && !empty($request)) {
            $holiday_id = $request->id;
            $holiday = Holiday::find($holiday_id);
            $holiday->date = $request->date;
            $holiday->name = $request->name;
            $holiday->save();

             $holidays = Holiday::all();
        }
        $html = view('pages.admin._partial._holidays_list_html', compact('holidays', $holidays))->render();
        return $this->successResponse('Holiday has Successfully Updated', ['html' => $html, 'html_section_id' => 'holidaylist-section']);   
    }

    
}
