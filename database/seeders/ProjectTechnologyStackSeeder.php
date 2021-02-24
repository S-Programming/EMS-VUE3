<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectTechnologyStackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project_technology_stacks = [
            ['project_id' => '4', 'technology_stack_id' => '3'],
        ];
        DB::table('project_technology_stack')->insert($project_technology_stacks);
    }
}
