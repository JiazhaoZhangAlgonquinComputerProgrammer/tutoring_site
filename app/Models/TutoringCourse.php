<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class TutoringCourse extends Model
{
    use HasFactory;

    protected $table = 'tutoringcourses';

    public function tutors(){
      return $this->belongsTo('App\Models\Tutor');
    }
}
