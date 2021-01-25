<?php

namespace App\Model;

use App\Traits\secureDelete;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use secureDelete;

	public function job_post(){
        return $this->belongsToMany('App\Model\JobPost','qualification_job_post','qualification_id','job_post_id');
    }
}
