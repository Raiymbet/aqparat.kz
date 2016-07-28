<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Raiymbet Tukpetov',
            'email' => 'tukpetov@bk.ru',
            'password' => bcrypt('qwerty12345'),
            'type' => 'admin',
        ]);
    }
}
