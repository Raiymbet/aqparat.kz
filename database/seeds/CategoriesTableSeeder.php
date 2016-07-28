<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Қазақстан',
        ]);

        DB::table('categories')->insert([
            'name' => 'Әлем',
        ]);

        DB::table('categories')->insert([
            'name' => 'Саясат',
        ]);

        DB::table('categories')->insert([
            'name' => 'Экономика',
        ]);

        DB::table('categories')->insert([
            'name' => 'Қоғам',
        ]);

        DB::table('categories')->insert([
            'name' => 'Мәдениет',
        ]);

        DB::table('categories')->insert([
            'name' => 'Спорт',
        ]);
    }
}
