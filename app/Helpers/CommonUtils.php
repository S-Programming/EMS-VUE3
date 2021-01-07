<?php

namespace App\Helpers;

use App\Http\Traits\AuthUser;
use App\Models\CheckinHistory;

class CommonUtils {
use AuthUser;
    /**
     * Utility method to return true only if already checkin
     *
     * @return  bool  true if string is not null and not an empty string
     */
    public function isCheckIn() {
        $userid=$this->isUserCheckin();
        $checkinHistoryData = CheckinHistory::where('user_id', $userid)->latest()->first();
        return (!is_null($checkinHistoryData) && is_null($checkinHistoryData->checkout));
    }
}
