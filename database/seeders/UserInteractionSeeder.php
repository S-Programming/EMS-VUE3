<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserInteractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userInteractions = [
            ['staff_id' => '2', 'user_id' => '3', 'description' => 'Lorem 3 Ipsum','date'=>Carbon::now()->format('Y-m-d H:i:s'),'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['staff_id' => '1', 'user_id' => '3', 'description' => 'Ipsum 3 Lorem','date'=>Carbon::now()->format('Y-m-d H:i:s'),'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['staff_id' => '2', 'user_id' => '4', 'description' => 'Ipsum 4 Ipsum','date'=>Carbon::now()->format('Y-m-d H:i:s'),'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['staff_id' => '2', 'user_id' => '1', 'description' => 'Lorem 1 Ipsum','date'=>Carbon::now()->format('Y-m-d H:i:s'),'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table('user_interactions')->insert($userInteractions);
    }
}
