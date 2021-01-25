<?php

namespace App\model;

use App\Traits\secureDelete;
use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
    use secureDelete;

    public function user(){
        return $this->hasMany('App\User','company_type_id','id');
    }
}
