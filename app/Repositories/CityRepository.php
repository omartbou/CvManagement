<?php

namespace App\Repositories;

use App\Models\City;

class CityRepository
{
    public function get(){
         return City::get();
    }

}
