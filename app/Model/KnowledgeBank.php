<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KnowledgeBank extends Model
{
    protected $appends = ['video_id','video_img','file_path'];
	
	public function getFilePathAttribute() {

        if($this->file != NULL && $this->file != "" ) {
            return asset('storage/'.$this->file);
		}
		
        return null;
    }

    public function getVideoIdAttributeOld()
  	{
	    if ($this->link != ''){
	    	$link = $this->link;
		    $video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
	        if (empty($video_id[1]))
	            $video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..
	        $video_id = explode("&", $video_id[1]); // Deleting any other params
	        $video_id = $video_id[0];
	      
	      return $video_id;
	    }else{
	      return "";
	    }
	    
	}
    public function getVideoIdAttribute() {
        if ($this->link != '') {
            $url = $this->link;
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
            $videoID = (isset($match[1])) ? $match[1] :'';
            return $videoID;
        }else{
            return "";
        }
    }
	public function getVideoImgAttribute()
  	{
	    if ($this->link != ''){
            $url = $this->link;
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
            $videoID = (isset($match[1])) ? $match[1] :'';
	        $urlImg = 'https://img.youtube.com/vi/'.$videoID.'/0.jpg';
	      return $urlImg;
	    }else{
	      return "";
	    }
	    
	}
}
