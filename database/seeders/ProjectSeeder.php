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
            ['name' => 'Login','description'=>'Login Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'), 'user_id'=>10,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Checkout','description'=>'Checkout Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'), 'user_id'=>11,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'bayan','description'=>'bayan Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'), 'user_id'=>12,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'AloExpo','description'=>'AloExpo Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'), 'user_id'=>4,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Remit Scanner','description'=>'Remit Scanner Project','start_date' => Carbon::now()->format('Y-m-d H:i:s'), 'user_id'=>13,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table('projects')->insert($projects);
    }
}
