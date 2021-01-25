<?php

namespace App\Model;

use App\Traits\secureDelete;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use secureDelete;

	public function job_post(){
		return $this->belongsToMany('App\Model\JobPost','job_types_job_post','job_type_id','job_post_id');
	}

   public function user(){
        return $this->belongsToMany('App\Model\JobType','job_seeker_job_type','jobtype_id','user_id');
    }
}
