<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB; 

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'To Do'],
            ['name' => 'In Progress'],
            ['name' => 'Testing'],
            ['name' => 'Done'],
            ['name' => 'Pending'],
        ];

        DB::table('categories')->insert($categories);
    }
}
