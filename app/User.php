<?php

namespace App;

use App\Model\Industries;
use App\Notifications\UserResetPassword;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'provider_id', 'provider', 'user_type', 'is_otp_verify', 'otp', 'is_active', 'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $appends = ['employer_profile_image','job_seeker_profile_image','admin_profile'];
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPassword($token));
    }
    public function getEmployerProfileImageAttribute()
    {
        if ($this->profile_image != NULL && $this->profile_image != "") {
            return asset('storage/profile_image/' . $this->profile_image);
        }

        // return asset('storage/default/picture.png');
        return null;
    }

    public function getAdminProfileAttribute()
    {
        if ($this->profile_image != NULL && $this->profile_image != "") {
            return asset('storage/' . $this->profile_image);
        }

        // return asset('storage/default/picture.png');
        return null;
    }

    public function getJobSeekerProfileImageAttribute()
    {
        if ($this->profile_image != NULL && $this->profile_image != "") {
            return asset('storage/profile_image/' . $this->profile_image);
        }

        // return asset('storage/default/picture.png');
        return null;
    }

    public function user_job_apply()
    {
        return $this->hasMany('App\Model\UserJobApply', 'user_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo('App\Model\State', 'state_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo('App\Model\City', 'city_id', 'id');
    }

    public function work_experience()
    {
        return $this->hasMany('App\Model\JobSeekerWorkExperience', 'user_id', 'id')->orderBy('created_at', 'asc');
    }

    public function qualification()
    {
        return $this->hasMany('App\Model\JobSeekerQualification', 'user_id', 'id')->orderBy('created_at', 'asc');
    }

    public function functional_area()
    {
        return $this->belongsToMany('App\Model\FunctionalArea', 'job_seeker_functional_area', 'user_id', 'functional_area_id');
    }

    public function preferred_location()
    {
        return $this->belongsToMany('App\Model\Locality', 'job_seeker_preferred_location', 'user_id', 'preferred_location_id');
    }

    public function job_type()
    {
        return $this->belongsToMany('App\Model\JobType', 'job_seeker_job_type', 'user_id', 'jobtype_id');
    }

    public function skill(){
        return $this->belongsToMany('App\Model\Skills', 'job_seeker_skill', 'user_id', 'skill_id');
    }

    public function known_languages()
    {
        return $this->belongsToMany('App\Model\KnownLanguages', 'job_seeker_known_language', 'user_id', 'knownlanguage_id');
    }

    public function interests()
    {
        return $this->belongsToMany('App\Model\Industries', 'job_seeker_interests', 'user_id', 'interests_id');
    }

    public function employerIndustries()
    {
        return $this->belongsToMany('App\Model\Industries', 'job_seeker_interests', 'user_id', 'interests_id');
    }

    public function job_seeker_city()
    {
        return $this->belongsToMany('App\Model\City', 'job_seeker_location', 'user_id', 'city_id');
    }

    public function user_job_post()
    {
        return $this->hasMany('App\Model\JobPost', 'user_id', 'id');
    }
    public function maritalStatus()
    {
        return $this->belongsTo('App\Model\MaritalStatus', 'marital_status_id', 'id');
    }
    public function category()
    {
        return $this->belongsToMany('App\Model\Category', 'category_user', 'user_id', 'category_id');
    }

    public function user_workspace_photo()
    {
        return $this->hasMany('App\Model\UserWorksapcePhoto', 'user_id', 'id');
    }
    public function companyType()
    {
        return $this->belongsTo('App\Model\CompanyType', 'company_type_id', 'id');
    }

    public function career_level()
    {
        return $this->belongsTo('App\Model\CareerLevels', 'career_level_id', 'id');
    }

    public function locality()
    {
        return $this->belongsTo('App\Model\Locality', 'locality_id', 'id');
    }

    public function messages(){
        return $this->hasMany(Model\Chat::class,'user_id');
    }

    public function is_featured(){
        return $this->hasOne(Model\Payment::class,'user_id');
    }
}
