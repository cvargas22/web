<?php

use App\Institucion;
use Illuminate\Database\Seeder;


class InstitucionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institucion')->delete();

        $institucion = Institucion::create(array(
        	'rut_inst' => '81.534.189-5',
        	'nombre' => 'Comedor San Antonio',
        	'direccion' => 'calle falsa 123',
        	'mail' => 'asda@asdasd.com',
        	'telefono' => 98123741,
        	'mision' => "asdasdjalsd",
        	"vision" => "alskdmalskdmlaskdlasd"
       	));
        $this->command->info('Institucion creada.');

        $institucion = Institucion::create(array(
            'rut_inst' => '92.164.732-1',
            'nombre' => 'Hogar Belen',
            'direccion' => 'calle falsa 345',
            'mail' => 'asd2@asdasd.com',
            'telefono' => 93456512,
            'mision' => "tyutyutyut",
            "vision" => "rttyhdfghasdsdfsdfgdf"
        ));
        $this->command->info('Institucion 2 creada.');

    }
}