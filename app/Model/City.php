<?php

namespace App\Model;

use App\Traits\secureDelete;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use secureDelete;

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function user(){
        return $this->belongsToMany('App\Model\User','job_seeker_location','city_id','user_id');
    }

    public function job_post(){
        return $this->hasMany(JobPost::class, 'city_id');
    }

    public function locality(){
        return $this->hasMany(Locality::class, 'city_id');
    }

}
