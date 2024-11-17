<?php

namespace App\Repositories;

use App\Models\Cv;
use Illuminate\Support\Facades\Auth;

class CvRepository
{
    public function get(){
        $cvs = Cv::with(['user','city','language','job'])->get();
        return $cvs;
    }
    public function store(array $data) {
        return Cv::create([
            'FilePath' => $data['FilePath'],
            'user_id'=>Auth::User()->id,
            'city_id' => $data['ville'],
            'job_id' => $data['metier'],
            'email' => $data['email'],
            'language_id' => $data['langue'],
        ]);
    }

}


