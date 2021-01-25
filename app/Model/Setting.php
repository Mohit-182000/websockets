<?php

namespace App\Model;

use App\Traits\LocationTrait;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use LocationTrait;
    //
    protected $guarded = [];

    public function getFaviconImageAttribute()
    {
        $imageExist  =  \Storage::disk('public')->exists('generalsetting/'.$this->favicon);  
        if($imageExist && $this->favicon != NULL && $this->favicon != "" ) {
            return asset('storage/generalsetting/'.$this->favicon );
        }
        return asset('storage/default/picture.jpg');
    }

    public function getLogoImageAttribute(){
        
        $imageExist  =  \Storage::disk('public')->exists('generalsetting/'.$this->logo);

        if($imageExist && $this->logo != NULL && $this->logo != "" ) {
            return asset('storage/generalsetting/'.$this->logo );
        }
        return asset('storage/default/picture.png');
    }

    public function getWatermarkImagesAttribute() {

        $imageExist  =  \Storage::disk('public')->exists('generalsetting/'.$this->watermark_image);
        if( $imageExist && $this->watermark_image != NULL && $this->watermark_image != "" ) {
            return asset('storage/generalsetting/'.$this->watermark_image );
        }
        return asset('storage/default/picture.png');
    }
}
