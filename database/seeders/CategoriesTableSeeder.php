<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'شقق',
            'فلل',
            'محلات تجارية',
            'مكاتب',
            'أراضي',
        ];

        foreach ($categories as $category) {
            DB::table('t_categories')->insert([
                's_name' => $category,
                'b_enabled' => 1,
                'dt_created_date' => now(),
                'dt_modified_date' => now(),
            ]);
        }
    }
}
