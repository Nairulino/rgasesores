<?php

use App\Empresa;
use Illuminate\Database\Seeder;

class EmpresasTableFactory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Empresa::class, 50)->create();
    }
}
