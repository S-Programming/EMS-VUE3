<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Services\SuperAdminService;
use Carbon\Carbon;


class SuperAdminController extends Controller
{

    protected $superAdminService;
    public function __construct(SuperAdminService $superAdminService)
    {
        $this->middleware('auth');
        $this->superAdminService = $superAdminService;
    }
    /**
     *
     *
     * return body
     */
    public function index()
    {
        dd("gfgfg");
    }
}
