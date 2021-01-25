<?php
namespace App\Traits;
use App\Model\City;
use App\Model\State;
use App\Model\Country;
use App\Model\Hotel;

trait LocationTrait {

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    
}
