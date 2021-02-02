<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	protected $fillable = [
        'name', 'duration', 'start', 'end', 'group_id'
    ];
    public function modules()
    {
        return $this->belongsToMany('App\Module');
    }
    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
