<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityList extends Model
{
    protected $table = 'lists';
    protected $fillable = [
        'prof_of_output'
    ];

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

}
