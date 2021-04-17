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
            ['name' => 'BoothCentral','description'=>'BoothCentral Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'),'estimate_time' => '2', 'project_manager_id'=>4,'number_of_developers'=>4, 'pm_description'=>'This is pm description.','project_progress'=>'0','project_status'=>0,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'bayan','description'=>'Bayan Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'), 'estimate_time' => '1','project_manager_id'=>4,'number_of_developers'=>9,'pm_description'=>'This is pm description.','project_progress'=>'100','project_status'=>5,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'AloExpo','description'=>'AloExpo Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'), 'estimate_time' => '5','project_manager_id'=>4,'number_of_developers'=>4,'pm_description'=>'This is pm description.','project_progress'=>'0','project_status'=>2,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Remit Scanner','description'=>'Remit Scanner Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'), 'estimate_time' => '9','project_manager_id'=>4,'number_of_developers'=>6,'pm_description'=>'This is pm description.','project_progress'=>'0','project_status'=>2,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Plexuss','description'=>'Plexus Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'), 'estimate_time' => '9','project_manager_id'=>4,'number_of_developers'=>1,'pm_description'=>'This is pm description.','project_progress'=>'0','project_status'=>0,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table('projects')->insert($projects);
    }
}
