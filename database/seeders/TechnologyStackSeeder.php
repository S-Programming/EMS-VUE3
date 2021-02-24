<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnologyStackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technology_stack = [
            ['name' => 'Laravel','created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'DotNet','created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Python','created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Bootstrap','created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Tailwind','created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'React','created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table('technology_stacks')->insert($technology_stack);
    }
}
