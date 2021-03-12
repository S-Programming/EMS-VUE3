<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            ['name' => 'Software Engineer','description'=>'This job is for everyone.','no_of_employee'=>2,'department_name' => 'Web Department', 'city'=>'Lahore','last_date'=>Carbon::tomorrow()->format('Y-m-d H:i:s'),'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Quality Assurance','description'=>'This job is for everyone.','no_of_employee'=>3,'department_name' => 'Web Department', 'city'=>'Lahore','last_date'=>Carbon::tomorrow()->format('Y-m-d H:i:s'),'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Manager','description'=>'This job is for everyone.','no_of_employee'=>4,'department_name' => 'Web Department', 'city'=>'Lahore','last_date'=>Carbon::tomorrow()->format('Y-m-d H:i:s'),'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Developer','description'=>'This job is for everyone.','no_of_employee'=>5,'department_name' => 'Gaming', 'city'=>'Lahore','last_date'=>Carbon::tomorrow()->format('Y-m-d H:i:s'),'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Designer','description'=>'This job is for everyone.','no_of_employee'=>6,'department_name' => 'Web Department', 'city'=>'Lahore','last_date'=>Carbon::tomorrow()->format('Y-m-d H:i:s'),'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Gamer','description'=>'This job is for everyone.','no_of_employee'=>1,'department_name' => 'Gaming', 'city'=>'Lahore','last_date'=>Carbon::tomorrow()->format('Y-m-d H:i:s'),'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table('jobs')->insert($jobs);
    }
}
