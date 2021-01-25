<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FunctionalArea extends Model
{
	public function job_post(){
        return $this->belongsToMany('App\Model\JobPost','functional_area_job_post','functional_area_id','job_post_id');
    }

    public function functional_area(){
        return $this->belongsToMany('App\Model\User','job_seeker_functional_area','functional_area_id','user_id');
    }
}
