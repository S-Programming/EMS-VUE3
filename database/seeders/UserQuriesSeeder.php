<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserQuriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_quries = [
            ['user_id' => '3','query_status_id'=>'1','topic' => "Logic", 'description' => 'Lorem Ipsum Lorem','comment' => "Hy",'is_view'=>"Viewed"],
            ['user_id' => '3','query_status_id'=>'2','topic' => "Inheritance", 'description' => 'Lorem Ipsum Lorem','comment' => "By",'is_view'=>"Viewed"],
            ['user_id' => '4','query_status_id'=>'4','topic' => "Namaz", 'description' => 'Lorem Ipsum Lorem','comment' => "Good",'is_view'=>"Viewed"],
            ['user_id' => '4','query_status_id'=>'3','topic' => "Access", 'description' => 'Lorem Ipsum Lorem','comment' => "Great",'is_view'=>"Viewed"],
            ['user_id' => '3','query_status_id'=>'2','topic' => "Work", 'description' => 'Lorem Ipsum Lorem','comment' => "Wao",'is_view'=>"Viewed"],
        ];
        DB::table('user_quries')->insert($user_quries);
    }
}
