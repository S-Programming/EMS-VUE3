<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'Super admin', 'route' => '/dashboard'],
            ['id' => 2, 'name' => 'Admin', 'route' => '/dashboard'],
            ['id' => 3, 'name' => 'EngagementManager', 'route' => '/dashboard'],
            ['id' => 4, 'name' => 'ProjectManager', 'route' => '/dashboard'],

            ['id' => 5, 'name' => 'Developer', 'route' => '/dashboard'],
            ['id' => 6, 'name' => 'UIDeveloper', 'route' => '/dashboard'],
            ['id' => 7, 'name' => 'UIDesigner', 'route' => '/dashboard'],
            ['id' => 8, 'name' => 'QualityAssurance', 'route' => '/dashboard'],

            ['id' => 9, 'name' => 'HumanResource', 'route' => '/dashboard'],



        ];
        DB::table('roles')->insert($roles);
    }
}
