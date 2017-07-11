<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name', 'description', 'tstatus', 'cuser_id', 'muser_id', 'sdate', 'edate',
    ];
}
