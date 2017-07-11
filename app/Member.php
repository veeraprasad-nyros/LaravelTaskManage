<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
   protected $fillable = [
        'cuser_id', 'team_id', 'muser_id'
    ];

}
