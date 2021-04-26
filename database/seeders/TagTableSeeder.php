<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tag = [
            ['name' => 'Early', 'color' => '#0d6efd', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Late', 'color' =>  '#dc3545', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Half Day', 'color' =>  '#ffc107', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Less then 8 hours', 'color' =>  '#1b2a4e', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table('tags')->insert($tag);
    }
}
