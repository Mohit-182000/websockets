<?php

namespace App\Model;

use App\Traits\secureDelete;
use Illuminate\Database\Eloquent\Model;

class Industries extends Model
{
    use secureDelete;

    protected $appends = ['industries_image'];

	public function job_post(){
        return $this->belongsToMany('App\Model\JobPost','industries_job_post','industries_id','job_post_id');
    }

    public function user(){
        return $this->belongsToMany('App\Model\Industries','job_seeker_interests','interests_id','user_id');
    }

    public function getIndustriesImageAttribute()
	{
		if ($this->image != NULL && $this->image != "") {
			return asset('storage/industries/' . $this->image);
		}

		return asset('storage/default/picture.png');
	}

}
