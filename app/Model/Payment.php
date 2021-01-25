<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
    public function job(){
        return $this->belongsTo('App\Model\JobPost','job_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function package(){
        return $this->belongsTo('App\Model\Package','package_id','id');
    }
}
