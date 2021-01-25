<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Traits\secureDelete;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salary extends Model
{
    use secureDelete;

    public function jobpost(){
        return $this->hasMany(JobPost::class,'salary');
    }
}
