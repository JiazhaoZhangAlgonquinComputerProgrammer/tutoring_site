<?php

namespace App\Http\Controllers;
use App\Models\TutoringCourse;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function registerCourse(Request $request){
      // return view('CourseManagement.register_course');
      if($request->session()->has('username')){
        $username = $request->session()->get('username');
        return view('CourseManagement.register_course',['username' => $username]);
      }
    }

    public function showCourses(Request $request){
      if($request->session()->has('username')){
        $username = $request->session()->get('username');
        $user = User::where('name','=',$username)->firstOrFail();
        $courses = $user->tutoringcourses;
        // dd($courses[0]);
        // var_dump($courses);
        return view('CourseManagement.show_courses',
                      ['username' => $username,
                       'courses' => $courses]);
      }else{
        return redirect('/admin');
      }
    }
}
