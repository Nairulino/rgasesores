<?php

use App\User;
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

        factory(User::class, 50)->create();
        
    }
}
