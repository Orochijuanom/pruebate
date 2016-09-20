<?php

use Illuminate\Database\Seeder;

class MateriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('materias')->insert([
            'descripcion' => 'Matematicas'
        ]);

        DB::table('materias')->insert([
            'descripcion' => 'Español'
        ]);

        DB::table('materias')->insert([
            'descripcion' => 'Religion'
        ]);

        DB::table('materias')->insert([
            'descripcion' => 'Biologia'
        ]);

        DB::table('materias')->insert([
            'descripcion' => 'Quimica'
        ]);

        DB::table('materias')->insert([
            'descripcion' => 'Fisica'
        ]);

        DB::table('materias')->insert([
            'descripcion' => 'Filosofia'
        ]);
    }
}
