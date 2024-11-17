<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'cv';
    protected $fillable = [
        'FilePath',
        'city_id',
        'job_id',
        'user_id',
        'language_id',
        'email',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
    public function language()
    {
        return $this->belongsTo(Language::class,'language_id');
    }

}
