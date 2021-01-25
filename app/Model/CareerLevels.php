<?php

namespace App\Model;

use App\Traits\secureDelete;
use Illuminate\Database\Eloquent\Model;

class CareerLevels extends Model
{   
    use secureDelete;

    public function job_post(){
        return $this->belongsToMany('App\Model\JobPost','career_level_job_post','career_level_id','job_post_id');
    }

    public function user(){
        return $this->hasMany('App\User','career_level_id','id');
    }
}
