<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    public function tutoringCourses(){
        return $this->hasMany('App\Models\TutoringCourse', 'owner_id', 'id');
    }
}
