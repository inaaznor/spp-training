<?php

namespace Database\Seeders;

use App\Models\Lookup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'desc' => "PEGAWAI PERKHIDMATAN PENDIDIKAN GRED DG29",
                'key' => "DG29"
                ],
                [
                'desc' => "PEGAWAI PERKHIDMATAN PENDIDIKAN GRED DG41",
                'key' => "DG41"
                ],
                [
                'desc' => "PEGAWAI PERKHIDMATAN PENDIDIKAN LEPASAN DIPLOMA GRED DGA29",
                'key' => "DGA29"
                ],
                [
                'desc' => "PEGAWAI PERKHIDMATAN PENDIDIKAN SISWAZAH GRED DG41",
                'key' => "DG41"
                ],
                [
                'desc' => "PEGAWAI PENDIDIKAN PENGAJIAN TINGGI GRED DH29",
                'key' => "DH29"
                ],
                [
                'desc' => "PEGAWAI PENDIDIKAN PENGAJIAN TINGGI GRED DH41",
                'key' => "DH41"
                ],
                [
                'desc' => "PEGAWAI PENDIDIKAN PENGAJIAN TINGGI GRED DH47",
                'key' => "DH47"
                ],
                
        ];

        foreach ($data as $key => $value) {
            $model = new Lookup();

            $model->key = $value['key'];
            $model->value = $value['desc'];

            $model->save();
        }
    }
}