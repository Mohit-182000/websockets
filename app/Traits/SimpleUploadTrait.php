<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

trait SimpleUploadTrait {

	protected $attributes = [];

	protected $file = '';

	/**
	 * Upload the file with slugging to a given path
	 *
	 * @param UploadedFile $image
	 * @param $path
	 * @return string
	 */
	public function uploadImages($destination_path, Array $dimension = NULL, $disk = 'public') {
		
		if (request()->has($this->file)) {

			$file = request()->file($this->file); // setfile

			$new_file_name = time() . 'mns__mns' . rand(0, 100) . 'mns__mns' . $file->getClientOriginalName(); // filename

			$new_file_name = str_replace(' ', '_', strtolower($new_file_name));

			$destination_path = ($dimension != NULL) ? $destination_path . '/' . time() . '_' . rand(0, 9999) : $destination_path;

			$file_path = $file->storeAs($destination_path, $new_file_name, $disk); // savefile

			if ($disk == 'public' || $disk == 'local') {
				$this->attributes[$this->file] = $file_path;
			}

			if ($dimension !== NUll && is_array($dimension)) {
				$this->makeThumb($dimension, $destination_path . '/thumb/');
			}

			return $new_file_name;

		}

	}

    public function makeThumb(Array $dimension ,$destination_path , $disk = 'public' )
    {       
        $file  = request()->file($this->file)->getRealPath() ;

        $dimension_data = collect($dimension) ;
        // dd($dimension_data);
        if (is_array($dimension_data->first())) {

            foreach($dimension_data as $key => $item) {
    
                $thumb_img = Image::make($file)->resize( $item[0] , $item[1] ,function ($constraint){
                    $constraint->aspectRatio();
                } )->encode('png', 100);

                Storage::put($destination_path.$item[0].'_'.$item[1].'_thumb.png', $thumb_img);    
                
            };            
            
            return $this;

        } 

        $thumb_img = Image::make($file)->resize( $dimension[0] , $dimension[1] ,function ($constraint){
            $constraint->aspectRatio();
        } )->encode('png', 100);
        Storage::put($destination_path.$dimension[0].'_'.$dimension[1].'_thumb.png', $thumb_img);    

        return $this;

	}
	
	public function setFile($file) {
		$this->file = $file;
		return $this;
	}

	public function imageUrl() {
		$collection = collect($this->attributes);
		return $collection->get($this->file, NULl);
	}

	public function unlinkImage($path, $disk = 'public') {
		Storage::disk($disk)->delete($path);
		return $this;
	}

	    /**
    * @return type
    */
    public function getbase64img( $disk = 'public' )
    {
        $collection = collect($this->attributes)->get($this->file);
        if(is_null($collection)) {
            return NULL ;
        }
        $file = Storage::disk($disk)->get($collection) ;     
        return $collection ?  base64_encode($file) : NUll  ;        
    }

}