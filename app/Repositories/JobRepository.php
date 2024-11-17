<?php

namespace App\Repositories;

use App\Models\Job;

class JobRepository
{
    public function get(){
        return Job::get();
    }
}
