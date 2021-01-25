<?php

namespace App\model;

use App\Traits\secureDelete;
use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    use secureDelete;

    public function state(){
    	return $this->belongsTo('App\Model\State','state_id','id');
    }

    public function city(){
    	return $this->belongsTo('App\Model\City','city_id','id');
    }

    public function job_seeker()
    {
        return $this->belongsToMany('App\User', 'job_seeker_preferred_location', 'preferred_location_id', 'user_id');
    }
}
