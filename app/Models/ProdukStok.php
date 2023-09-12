<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukStok extends Model
{
    use HasFactory;

    public static function getTotalStokProduk($id_produk)
    {
        $pemasukkan = self::where('id_produk_lapak', $id_produk)
            ->where('jenis', 'pemasukkan')
            ->sum('jumlah');

        $pengeluaran = self::where('id_produk_lapak', $id_produk)
            ->where('jenis', 'pengeluaran')
            ->sum('jumlah');

        return $pemasukkan - $pengeluaran;
    }
}
