<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(admin::class);
        $this->call(UserTableSeeder::class);
        $this->call(SociedadesTableFactory::class);
        $this->call(EmpresasTableFactory::class);
    }
}
