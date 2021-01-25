<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserJobApply extends Model
{
	protected $table = 'user_job_apply';

	// protected $primaryKey = null;
 //    public $incrementing = false;

	protected $fillable = [
						'user_id',
						'job_id',
						'is_shortlisted',
						'is_wishlist',
						'applied_date',
						'shortlist_date'
					];

	public function user(){
		return $this->belongsTo('App\User','user_id','id');
	}

	public function job_post(){
		return $this->belongsTo('App\Model\JobPost','job_id','id');
	}
}
