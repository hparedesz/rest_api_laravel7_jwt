<?php

use Illuminate\Database\Seeder;

class DirectorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('directorios')->insert([
            "nombre"=>"Harold Paredes",
            "direccion"=>"Jutiapa",
            "telefono"=>1,
            "foto"=>null
        ]);
    }
}
