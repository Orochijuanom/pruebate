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
            'email' => 'orochijuan.nom@gmail.com',
            'password' => bcrypt('123456'),
            'role_id' => '1'
        ]);
    }
}
