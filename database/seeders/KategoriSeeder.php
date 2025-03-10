<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_kode' => 'KTG1', 'kategori_nama' => 'Elektronik'],
            ['kategori_kode' => 'KTG2', 'kategori_nama' => 'Pakaian'],
            ['kategori_kode' => 'KTG3', 'kategori_nama' => 'Makanan'],
            ['kategori_kode' => 'KTG4', 'kategori_nama' => 'Minuman'],
            ['kategori_kode' => 'KTG5', 'kategori_nama' => 'Alat Tulis'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
