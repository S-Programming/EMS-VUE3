<?php

namespace App\Http\Services\BaseService;

use App\Http\Traits\ApiResponse;
use App\Http\Traits\AuthUser;
use App\Http\Traits\GlobalSettingsTrait;
use App\Http\Traits\UserTrait;
use App\Http\Traits\CommonMethods;
use App\Http\Traits\CookiesTrait;
use App\Http\Traits\DevTestLogs;
use App\Http\Traits\FailureLogs;
use App\Http\Traits\RecordsActivity;

class BaseService
{
    /*## Custom Traits  ##*/
    use FailureLogs;
    use CommonMethods;
    use ApiResponse;
    use AuthUser;
    use UserTrait;
    use GlobalSettingsTrait;
}
