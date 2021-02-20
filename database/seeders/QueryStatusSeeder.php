<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QueryStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $query_status = [
            ['query_status'=> 'In Progress','created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['query_status'=> 'Completed','created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['query_status'=> 'Pending','created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['query_status'=> 'Rejected','created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table('query_statuses')->insert($query_status);
    }
}
