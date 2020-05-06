<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sidang extends Model
{
    protected $table = 'sidang';
    protected $primaryKey = 'kd_sidang';

    protected $fillable = [
        'nama_terperiksa',
        'tempat',
        'keterangan',
        'tanggal_sidang'
    ];
}
