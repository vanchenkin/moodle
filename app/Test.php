<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	protected $fillable = [
        'name', 'duration', 'start', 'end', 'group_id'
    ];
    protected $casts = [
        'start'  => 'datetime',
        'end'  => 'datetime',
    ];
    public function modules()
    {
        return $this->belongsToMany('App\Module')->withPivot('count');
    }
    public function attempts()
    {
        return $this->hasMany('App\Attempt');
    }
    public function group()
    {
        return $this->belongsTo('App\Group');
    }
    public function count(){
        $sum = 0;
        foreach($this->modules()->withTrashed()->get() as $module)
            $sum += $module->pivot->count;
        return $sum;
    }
}
