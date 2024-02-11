<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;

    // mendefinisikan nama kolom pada tabel yg boleh diisi
    protected $fillable = ['Nis', 'Nama', 'JenisKelamin', 'TanggalLahir', 'Alamat', 'Kota_ID'];

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'Kota_ID');
    }

    protected $guarded = [];

    // mendefinisikan nama tabel
    protected $table = 'siswa';

    public $timestamps = false;
}
