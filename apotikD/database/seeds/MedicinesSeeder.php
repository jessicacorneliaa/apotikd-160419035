<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicines')->insert([
            'generic_name' => 'Fentanil',
            'form' => 'inj 0,05 mg/mL (i.m/i.v)',
            'restriction_formula' => '5 amp/kasus',
            'description'=>'inj: Hanya untuk nyeri berat dan harus diberikan oleh tim medis yang dapat melakukan resusitasi.',
            'faskes_tk1' => false,
            'faskes_tk2' => true,
            'faskes_tk3' => true,
            'category_id' => 2,
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'Oksikodon',
            'form' => 'kaps 5 mg',
            'restriction_formula' => '60 kaps/bulan',
            'description'=> 'Untuk nyeri berat yang memerlukan terapi opioid jangka panjang, around-the-clock.',
            'faskes_tk1' => false,
            'faskes_tk2' => true,
            'faskes_tk3' => true,
            'category_id' => 2,
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'Ketoprofen',
            'form' => 'sup 100 mg',
            'restriction_formula' => '2 sup/hari, maks 3 hari.',
            'description'=> 'Untuk nyeri sedang sampai berat pada pasien yang tidak dapat menggunakan analgesik secara oral.',
            'faskes_tk1' => false,
            'faskes_tk2' => true,
            'faskes_tk3' => true,
            'category_id' => 3,
        ]);

        DB::table('medicines')->insert([
            'generic_name' => 'Metamizol',
            'form' => 'inj 500 mg/mL',
            'restriction_formula' => '4 amp selama dirawat',
            'description'=> 'Untuk nyeri post operatif dan hanya dalam waktu singkat.',
            'faskes_tk1' => false,
            'faskes_tk2' => true,
            'faskes_tk3' => true,
            'category_id' => 3,
        ]);
        
    }
}
