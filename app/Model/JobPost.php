<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    protected $table = 'job_post';

    protected $hidden = ['pivot'];

    public function qualification(){
        return $this->belongsToMany('App\Model\Qualification','qualification_job_post','job_post_id','qualification_id');
    }

    public function functional_area(){
        return $this->belongsToMany('App\Model\FunctionalArea','functional_area_job_post','job_post_id','functional_area_id');
    }

    public function job_type(){
        return $this->belongsToMany('App\Model\JobType','job_types_job_post','job_post_id','job_type_id');
    }

    public function skill(){
        return $this->belongsToMany('App\Model\Skills','skill_job_post','job_post_id','skill_id');
    }

    public function known_languages(){
        return $this->belongsToMany('App\Model\KnownLanguages','known_languages_job_post','job_post_id','known_languages_id');
    }

    public function industries(){
        return $this->belongsToMany('App\Model\Industries','industries_job_post','job_post_id','industries_id');
    }

    public function category(){
        return $this->belongsToMany('App\Model\Category','category_job_post','job_post_id','category_id');
    }

    public function experience(){
        return $this->belongsTo('App\Model\Experience','experience_id','id');
    }

    public function career_level(){
        return $this->belongsToMany('App\Model\CareerLevels','career_level_job_post','job_post_id','career_level_id');
    }

    public function shift(){
        return $this->belongsToMany('App\Model\Shifts','shift_job_post','job_post_id','shift_id');
    }

    public function marital_status(){
        return $this->belongsToMany('App\Model\MaritalStatus','job_post_marital_status','job_post_id','marital_status_id');
    }

    public function state(){
        return $this->belongsTo('App\Model\State','state_id','id');
    }

    public function city(){
        return $this->belongsTo('App\Model\City','city_id','id');
    }

    public function salary(){
        return $this->belongsTo(Salary::class,'salary');
    }

    public function user(){
        return $this->belongsTo('App\Model\User','user_id','id');
    }

    public function user_job_apply(){
        return $this->hasMany('App\Model\UserJobApply','job_id','id');
    }

    public function user_shortlist(){
        return $this->hasOne('App\Model\UserJobApply','job_id','id');
    }

    public function is_featured(){
        return $this->hasOne(Payment::class,'job_id');
    }
}
