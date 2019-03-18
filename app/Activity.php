<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

    protected $fillable = [
        'activity_name',
    ];

    //One to One Relationship
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function activitylists()
    {
        return $this->hasMany('App\ActivityList');
    }
}
