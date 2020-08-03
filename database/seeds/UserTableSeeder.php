<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.es',
            'password' => bcrypt('pruebas1'),
            'admin' => '1',
            'phone' => '666333999',
            'description' => ''
        ]);
    }
}
