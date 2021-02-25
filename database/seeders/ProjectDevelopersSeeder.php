<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectDevelopersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developers=[
        ['project_id'=>1,'user_id'=>21,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ['project_id'=>3,'user_id'=>23,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ['project_id'=>4,'user_id'=>24,'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table('project_developers')->insert($developers);

    }
}
