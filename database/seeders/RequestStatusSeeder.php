<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $requestStatus = [
            ['status' => 'Pending'], 
            ['status' => 'Approve'], 
            ['status' => 'Reject'], 
            
            
        ];
        DB::table('request_statuses')->insert($requestStatus);
    }
}
