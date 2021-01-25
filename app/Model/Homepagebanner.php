<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Storage;
use App\Admin;
class Homepagebanner extends Model
{
    //
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['banner_image'];

    public function getBannerImageAttribute() {

        $imageExist  = Storage::exists($this->slider_img);
        //dd( $imageExist);
       
        if( $imageExist && $this->slider_img != NULL && $this->slider_img != "" ) {
            return asset('storage/'.$this->slider_img );
        }
        //return asset('storage/default/picture.png');
    }

    public function usercreate()
    {
        return $this->belongsTo(Admin::class, 'created_user_id');
    }
    public function userupdate()
    {
        return $this->belongsTo(Admin::class, 'updated_user_id');
    }
}
