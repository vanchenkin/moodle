<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
	protected $fillable = [
        'user_id', 'test_id', 'start', 'end'
    ];
    protected $casts = [
        'start'  => 'datetime',
        'end'  => 'datetime',
    ];
    public function tasks()
    {
        return $this->belongsToMany('App\Task')->withPivot('answer');
    }
    public function test()
    {
        return $this->belongsTo('App\Test');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
