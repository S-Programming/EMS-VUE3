<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GlobalSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $globalSettings = [
            ['id' => 1, 'display_name' => 'Admin Email', 'field_name' => 'admin_email', 'value' => 'mudassarhussain08@gmail.com', 'value_type' => '0'],
            ['id' => 2, 'display_name' => 'Dev Email', 'field_name' => 'dev_email', 'value' => 'mudassarhussain08@gmail.com', 'value_type' => '0'],
            ['id' => 3, 'display_name' => 'Checkin time', 'field_name' => 'checkin_time', 'value' => '10:45', 'value_type' => '0'],
            ['id' => 4, 'display_name' => 'Checkin Margin', 'field_name' => 'checkin_margin', 'value' => 30, 'value_type' => 1],
            ['id' => 5, 'display_name' => 'Working Hours', 'field_name' => 'working_hours', 'value' => 7, 'value_type' => 1],
            ['id' => 6, 'display_name' => 'Working Hours Margin', 'field_name' => 'working_hour_margin', 'value' => 1, 'value_type' => 1],
        ];
        DB::table('global_settings')->insert($globalSettings);
    }
}
