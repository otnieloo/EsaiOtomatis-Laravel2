<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('teachers')->insert([
            'nama' => 'budi',
            'username' => 'budi_budi',
            'password' => Hash::make('asd'),
            'email' => 'budi@mail.com',
        ]); 
    }
}
