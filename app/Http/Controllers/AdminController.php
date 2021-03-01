<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Services\AdminService;
use Carbon\Carbon;


class AdminController extends Controller
{

    protected $adminService;
    public function __construct(AdminService $adminService)
    {
        $this->middleware('auth');
        $this->adminService = $adminService;
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
