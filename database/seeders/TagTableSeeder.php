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
            ['name' => 'Early', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Late', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Half Day', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Less then 8 hours', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table('tags')->insert($tag);
    }
}
