<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class UserWorksapcePhoto extends Model
{
	protected $table = 'user_workspace_photo';
	protected $appends = ['workspace_photo_url'];

	public function getWorkspacePhotoUrlAttribute()
	{
		//$imageExist  =  \Storage::exists('workspace_photo/' . $this->workspace_photo);
		//dd('workspace_photo/' . $this->workspace_photo);

		if ($this->workspace_photo != NULL && $this->workspace_photo != "") {
			return asset('storage/workspace_photo/' . $this->workspace_photo);
		}

		return asset('storage/default/picture.png');

		// return null;
	}
}
