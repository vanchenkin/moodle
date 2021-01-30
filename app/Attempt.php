<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
	protected $fillable = [
        'user_id', 'test_id', 'start', 'end'
    ];
}
