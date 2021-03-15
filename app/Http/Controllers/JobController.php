<?php

namespace App\Http\Controllers;

use App\Models\job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function jobList()
    {
        $jobs = job::all();
        return view('pages.humanResource.jobs',['jobs'=>$jobs]);
    }
    public function addJobModal(Request $request)
    {
        dd('sasasa');
//        dd("add modal");
    }
}
