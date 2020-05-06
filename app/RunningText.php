<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RunningText extends Model
{
    protected $table = 'running_text';
    protected $primaryKey = 'kd_running_text';

    protected $fillable = [
        'text',
        'status'
    ];
}
