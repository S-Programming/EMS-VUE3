<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PublicHolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         $publicHolidays = [
            ['date'=>'2021-02-05' ,'name' => 'Kashmir Day','created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')], 
            ['date'=>'2021-03-23' ,'name' => 'Labour Day','created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['date'=>'2021-05-01' ,'name' => 'Resolution Day','created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            
            
            
        ];
        DB::table('public_holidays')->insert($publicHolidays);
    }
}
