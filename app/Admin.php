<?php

namespace App;


use App\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Storage;
class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }
    public function getProfileImageAttribute($value)
    {

        $imageExist = Storage::disk('public')->exists($value);

        if ($imageExist && $value != NULL && $value != "") {
            return asset('storage/' . $value);
        }

        return asset('storage/default/picture.png');

    }

         /**
         * Get the user's full name.
         *
         * @return string
         */
    public function getFullNameAttribute()
    {
        return ucfirst($this->name);
        // return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }
    
    public function getImageThumpApiAttribute()
    {

        $imageExist = Storage::disk('public')->exists( $this->thum_path);

        if ($imageExist && $this->thum_path != NULL && $this->thum_path != "") {
            return asset('storage/'.$this->thum_path);
        }

        return null;

    }
}
