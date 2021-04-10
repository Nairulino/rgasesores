<?php

use App\Sociedade;
use Illuminate\Database\Seeder;

class SociedadesTableFactory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Sociedade::class, 50)->create();
    }
}
