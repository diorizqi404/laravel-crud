<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $table = 'kota';

    protected $fillable = ['NamaKota'];

    public $timestamps = false;

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
