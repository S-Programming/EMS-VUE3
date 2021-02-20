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
            ['user_id' => '3','query_status_id'=>'1','topic' => "Logic", 'description' => 'Lorem Ipsum Lorem','admin_comment' => "Good",'status'=> 'Good','is_view'=>"Viewd"],
            ['user_id' => '3','query_status_id'=>'2','topic' => "Inheritance", 'description' => 'Lorem Ipsum Lorem','admin_comment' => "Good",'status'=> 'Good','is_view'=>"Viewd"],
            ['user_id' => '4','query_status_id'=>'4','topic' => "Namaz", 'description' => 'Lorem Ipsum Lorem','admin_comment' => "Wow",'status'=> 'Good' ,'is_view'=>"Viewd"],
            ['user_id' => '4','query_status_id'=>'3','topic' => "Access", 'description' => 'Lorem Ipsum Lorem','admin_comment' => "Great",'status'=> 'Good' ,'is_view'=>"Viewd"],
            ['user_id' => '3','query_status_id'=>'2','topic' => "Work", 'description' => 'Lorem Ipsum Lorem','admin_comment' => "Bad",'status'=> 'Good' ,'is_view'=>"Viewd"],
        ];
        DB::table('user_quries')->insert($user_quries);
    }
}
