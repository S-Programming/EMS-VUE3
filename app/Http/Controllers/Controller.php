<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponse;
use App\Http\Traits\AuthUser;
use App\Http\Traits\CustomHash;
use App\Http\Traits\VerificationToken;
use App\Http\Traits\UserTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /*## Custom Traits  ##*/
    use ApiResponse;
    use AuthUser;
    use CustomHash;
    use VerificationToken;
    use UserTrait;
}
