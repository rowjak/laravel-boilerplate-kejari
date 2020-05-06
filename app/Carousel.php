<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    protected $table = 'carousel';
    protected $primaryKey = 'kd_carousel';

    protected $fillable = [
        'carousel',
        'keterangan',
        'link',
        'status'
    ];
}
