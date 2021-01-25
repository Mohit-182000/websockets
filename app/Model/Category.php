<?php

namespace App\Model;

use App\Traits\secureDelete;
use Illuminate\Database\Eloquent\Model;



class Category extends Model
{
 
  use secureDelete;
    public function children()
  {
    return $this->hasMany(Category::class, 'parent_id');
  }
  
    public function parentCat()
  {
    return $this->belongsTo(Category::class, 'parent_id');
  }

	public function skill()
  {
    return $this->belongsToMany('App\Model\Skills','category_skill','category_id','skill_id');
  }

  public function user()
    {
        return $this->belongsToMany('App\User', 'category_user', 'user_id', 'category_id');
    }

    public function job_post(){
      return $this->belongsToMany('App\Model\JobPost','category_job_post','category_id','job_post_id');
    }

}
