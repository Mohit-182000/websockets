<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['user_id', 'receiver_id', 'message'];
    
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
