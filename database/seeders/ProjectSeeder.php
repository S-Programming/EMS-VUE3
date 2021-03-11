<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            ['name' => 'Login','description'=>'Login Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'),'estimate_time' => '2', 'project_manager_id'=>10,'number_of_developers'=>4, 'pm_description'=>'This is pm description.','project_status'=>10,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Checkout','description'=>'Checkout Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'),'estimate_time' => '3', 'project_manager_id'=>11,'number_of_developers'=>5,'pm_description'=>'This is pm description.','project_status'=>10,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'bayan','description'=>'bayan Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'), 'estimate_time' => '1','project_manager_id'=>12,'number_of_developers'=>9,'pm_description'=>'This is pm description.','project_status'=>0,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'AloExpo','description'=>'AloExpo Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'), 'estimate_time' => '5','project_manager_id'=>4,'number_of_developers'=>4,'pm_description'=>'This is pm description.','project_status'=>0,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Remit Scanner','description'=>'Remit Scanner Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'), 'estimate_time' => '9','project_manager_id'=>13,'number_of_developers'=>6,'pm_description'=>'This is pm description.','project_status'=>2,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table('projects')->insert($projects);
    }
}
