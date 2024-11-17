<?php

namespace App\Repositories;

use App\Models\Language;

class LanguageRepository
{
    public function get(){
        return Language::get();
    }
}
