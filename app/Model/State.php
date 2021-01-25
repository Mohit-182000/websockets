<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\secureDelete;

class State extends Model
{
    use secureDelete;

    public function city(){
        return $this->hasMany(City::class, 'state_id');
    }

    public function job_post(){
        return $this->hasMany(JobPost::class, 'state_id');
    }

    public function locality(){
        return $this->hasMany(Locality::class, 'state_id');
    }

    public function user(){
        return $this->hasMany(User::class, 'state_id');
    }
}
