<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class JobSeekerQualification extends Model
{
	protected $fillable = ['user_id','school_name','qualification_id','field_of_study','start_date','current_study_here','end_date'];

	protected $table = 'job_seeker_qualification';
	protected $guarded = [];

	public function qualificationDetail()
	{
		return $this->belongsTo('App\Model\Qualification', 'qualification_id', 'id');
	}

	
}
