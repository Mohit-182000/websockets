<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{

	public function job_post(){
		return $this->hasMany('App\Model\JobPost','experience_id','id');
	}
}
