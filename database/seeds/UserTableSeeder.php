<?php

use Faker\Provider\bg_BG\PhoneNumber;
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
        for( $i = 0; $i < 50; $i++){
            $name = Str::random(10);
            DB::table('users')->insert([
                'name' => $name,
                'email' => $name . '@correo.es',
                'password' => Hash::make('pruebas1'),
                'phone' => rand(111111111,999999999),
                'description' => '',
                'img' => 'public/img/profile/default.png'
            ]);
        }
        
    }
}
