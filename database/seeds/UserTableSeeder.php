<?php

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
        DB::table('users')->insert([
            'name' => 'Juan Sebastian Cruz Perdomo',
            'email' => 'sebastian@netmasters.co',
            'password' => bcrypt('123456'),
            'role_id' => '1'
        ]);

        DB::table('users')->insert([
            'name' => 'Docente 1',
            'email' => 'docente@docente.com',
            'password' => bcrypt('123456'),
            'role_id' => '2'
        ]);

        DB::table('users')->insert([
            'name' => 'Estudiante 1',
            'email' => 'estudiante@estudiante.com',
            'password' => bcrypt('123456'),
            'role_id' => '3'
        ]);
    }
}
