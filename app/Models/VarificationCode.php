<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VarificationCode extends Model
{
    protected $fillable = ['user_id','code'];
}
