<?php

namespace App\Helpers;

class CommonUtils {

    /**
     * Utility method to return true only if already checkin
     *
     * @return  bool  true if string is not null and not an empty string
     */
    public function isCheckIn() {
        return intval(session('is_checkin', 0));
    }
}
