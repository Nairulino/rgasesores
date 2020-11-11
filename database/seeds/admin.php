<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class admin extends Seeder
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
            'email' => 'admin@rgasesores.es',
            'password' => Hash::make('pruebas1'),
            'admin' => '1',
            'phone' => '666333999',
            'description' => 'Soy el administrador',
            'img' => 'public/img/profile/default.png'
        ]);
    }
}
