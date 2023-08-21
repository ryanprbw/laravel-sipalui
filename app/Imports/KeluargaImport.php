<?php

namespace App\Imports;

use App\Models\DatabaseP3KE\P3keKeluarga;
use Maatwebsite\Excel\Concerns\ToModel;

class KeluargaImport implements ToModel
{

    public function model(array $row)
    {
        return new P3keKeluarga([
            'id_keluarga_P3KE' => $row[1],
            'provinsi' => $row[2],
            'kabupaten_kota' => $row[3],
            'kecamatan' => $row[4],
            'desa_kelurahan' => $row[5],
            'kode_kemdagri' => $row[6],
            'desil_kesejahteraan' => $row[7],
            'alamat' => $row[8],
            'kepala_keluarga' => $row[9],
            'nik' => $row[10],
            'padan_dukcapil' => $row[11],
            'jenis_kelamin' => $row[12],
            'tanggal_lahir' => $row[13],
            'pekerjaan' => $row[14],
            'pendidikan' => $row[15],
            'kepemilikan_rumah' => $row[16],
            'memiliki_simpananuang_perhiasan_ternak_lainnya' => $row[17],
            'jenis_atap' => $row[18],
            'jenis_dinding' => $row[19],
            'jenis_lantai' => $row[20],
            'sumber_penerangan' => $row[21],
            'bahan_bakar_memasak' => $row[22],
            'sumber_air_minum' => $row[23],
            'memiliki_fasilitas_buang_air_besar' => $row[24],
            'penerima_bpnt' => $row[25],
            'penerima_bpum' => $row[26],
            'penerima_bst' => $row[27],
            'penerima_pkh' => $row[28],
            'penerima_sembako' => $row[29],
            'resiko_stunting' => $row[30],
        ]);
    }
}
