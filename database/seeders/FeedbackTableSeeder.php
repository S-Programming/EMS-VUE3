<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FeedbackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $feedbacks = [
            ['first_name' => 'Saad', 'last_name' => 'Younas', 'email' => 'abbasnaumani+3@gmail.com','topic' => "Logic", 'description' => 'Lorem Ipsum Lorem','admin_comment' => "Good",'rate_status'=> 'Good','is_view'=>"Viewd"],
            ['first_name' => 'Hassam', 'last_name' => 'Mughal', 'email' => 'abbasnaumani+3@gmail.com','topic' => "Inheritance", 'description' => 'Lorem Ipsum Lorem','admin_comment' => "Good",'rate_status'=> 'Good','is_view'=>"Viewd"],
            ['first_name' => 'Asad', 'last_name' => 'Dogar', 'email' => 'asad@gmail.com','topic' => "Namaz", 'description' => 'Lorem Ipsum Lorem','admin_comment' => "Wow",'rate_status'=> 'Good' ,'is_view'=>"Viewd"],
            ['first_name' => 'Saleem', 'last_name' => 'Aslam', 'email' => 'saleem@gmail.com','topic' => "Access", 'description' => 'Lorem Ipsum Lorem','admin_comment' => "Great",'rate_status'=> 'Good' ,'is_view'=>"Viewd"],
            ['first_name' => 'Saddique', 'last_name' => 'Arian', 'email' => 'saddique@gmail.com','topic' => "Work", 'description' => 'Lorem Ipsum Lorem','admin_comment' => "Bad",'rate_status'=> 'Good' ,'is_view'=>"Viewd"],
        ];
        DB::table('feedback')->insert($feedbacks);
    }
}
