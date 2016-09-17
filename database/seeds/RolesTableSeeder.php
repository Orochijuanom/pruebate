<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'descripcion' => 'Administrador'
        ]);

        DB::table('roles')->insert([
            'descripcion' => 'Docente'
        ]);

        DB::table('roles')->insert([
            'descripcion' => 'Estudiante'
        ]);
    }
}
