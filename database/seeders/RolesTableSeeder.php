<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'guard_name' => 'admin',
                'created_at' => '2021-12-14 12:09:17',
                'updated_at' => '2021-12-14 12:09:17',
                'display_name' => 'مدير',
            ),
        ));
        
        
    }
}