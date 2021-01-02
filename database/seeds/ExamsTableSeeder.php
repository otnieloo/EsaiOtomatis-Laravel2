<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('exams')->insert([
            'nama' => 'ujian abc',
            'jumlah_soal' => '2',
            'id_pengajar' => '16',
            'kode_ujian' => 'Kiw1A',
            'jadwal' => '2021-01-02 18:00',
            'jadwal_selesai' => '2021-01-02 18:10',
            'durasi' => '90'
        ]); 
    }
}
