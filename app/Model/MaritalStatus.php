<?php

namespace App\Model;

use App\Traits\secureDelete;
use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    use secureDelete;

    public function user(){
        return $this->hasMany('App\User','marital_status_id','id');
    }

    public function job_post(){
        return $this->hasMany('App\Model\JobPost','marital_status_id','id');
    }
}
