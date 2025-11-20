<?php

namespace Database\Seeders;

use App\Models\TAdmin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TAdmin::create([
            's_name' => 'Admin',
            's_username' => 'admin',
            's_email' => 'admin@admin.com',
            's_password' => '123123',
        ]);
    }
}
