<?php

namespace App\Model;

use App\Traits\secureDelete;
use Illuminate\Database\Eloquent\Model;

class KnownLanguages extends Model
{
	use secureDelete;

	public function job_post(){
		return $this->belongsToMany('App\Model\JobPost','known_languages_job_post','known_languages_id','job_post_id');
	}

	public function user(){
        return $this->belongsToMany('App\Model\User','job_seeker_known_language','knownlanguage_id','user_id');
    }
}
