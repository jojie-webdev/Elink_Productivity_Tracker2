<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $fillable = [
        'prof_of_output'
    ];

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
