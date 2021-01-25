<?php

namespace App\Model;

use App\Traits\secureDelete;
use Illuminate\Database\Eloquent\Model;

class Shifts extends Model
{   
    use secureDelete;

    public function job_post(){
        return $this->belongsToMany('App\Model\JobPost','shift_job_post','shift_id','job_post_id');
    }
}
