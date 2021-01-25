<?php

namespace App\Model;

use App\Traits\secureDelete;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use secureDelete;

	public function category()
    {
        return $this->belongsToMany('App\Model\Category','category_skill','skill_id','category_id');
    }

    public function job_post(){
        return $this->belongsToMany('App\Model\JobPost','skill_job_post','skill_id','job_post_id');
    }

    public function user(){
        return $this->belongsToMany('App\Model\User','job_seeker_skill','skill_id','user_id');
    }
}
