<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class User extends Model
{
	protected $table = 'users';

	public function user_job_apply(){
		return $this->belongsToMany('App\Model\JobPost','user_job_apply','user_id','job_id');
	}

    public function state(){
        return $this->belongsTo('App\Model\State','state_id','id');
    }

    public function city(){
        return $this->belongsTo('App\Model\City','city_id','id');
    }

    public function work_experience(){
        return $this->hasOne('App\Model\JobSeekerWorkExperience','user_id','id');
    }

    public function qualification(){
        return $this->hasOne('App\Model\JobSeekerQualification','user_id','id');
    }

    public function functional_area(){
        return $this->belongsToMany('App\Model\FunctionalArea','job_seeker_functional_area','user_id','functional_area_id');
    }
    
    public function job_type(){
        return $this->belongsToMany('App\Model\JobType','job_seeker_job_type','user_id','jobtype_id');
    }

    public function skill(){
        return $this->belongsToMany('App\Model\Skills','job_seeker_skill','user_id','skill_id');
    }

    public function known_languages(){
        return $this->belongsToMany('App\Model\KnownLanguages','job_seeker_known_language','user_id','knownlanguage_id');
    }

    public function interests(){
        return $this->belongsToMany('App\Model\Industries','job_seeker_interests','user_id','interests_id');
    }

    public function job_seeker_city(){
        return $this->belongsToMany('App\Model\City','job_seeker_location','user_id','city_id');
    }

    public function user_job_post(){
        return $this->hasMany('App\Model\JobPost','user_id','id');
    }
    public function maritalStatus(){
        return $this->belongsTo('App\Model\MaritalStatus','marital_status_id','id');
    }

    public function getAvatarImgeAttribute()
    {

        $imageExist  =  \Storage::disk('public')->exists($this->avatar);

        if ($imageExist && $this->avatar != NULL && $this->avatar != "") {
            return asset('storage/profile_image/' . $this->avatar);
        }

        return asset('storage/default/picture.png');
    }

    public function category(){
        return $this->belongsToMany('App\Model\Category','category_user','user_id','category_id');
    }

    public function user_workspace_photo(){
        return $this->hasMany('App\Model\UserWorksapcePhoto','user_id','id');
    }

    public function companyType()
    {
        return $this->belongsTo('App\Model\CompanyType', 'company_type_id', 'id');
    }
    public function locality()
    {
        return $this->belongsTo('App\Model\Locality', 'locality_id', 'id');
    }
}
