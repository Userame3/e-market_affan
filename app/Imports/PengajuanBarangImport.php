<?php

namespace App\Imports;

use App\Models\PengajuanBarang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PengajuanBarangImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new PengajuanBarang([
            'id' => $row[0],
            'nama_pengajuan' => $row[1],
            'nama_barang' => $row[2],
            'tanggal_pengajuan' => $row[3],
            'qty' => $row[4],
            'terpenuhi' => $row[5]
        ]);
    }
}
