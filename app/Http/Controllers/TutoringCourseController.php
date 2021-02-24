<?php

namespace App\Http\Controllers;

use App\Models\TutoringCourse;
use App\Models\User;
use App\Models\Tutor;
use Illuminate\Http\Request;

class TutoringCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $courseName = $request->input('courseName');
        $CourseDesc = $request->input('course_desc');
        $coursePrice = $request->input('price');
        if($request->session()->has('username') && $request->session()->has('email')){

            if(trim($courseName)==''){
                return back()->with('empty_courseName',"Please input a course name");
            }
            $username = $request->session()->get('username');
            $email =  $request->session()->get('email');
            $tutor = Tutor::where('username','=',$username)->orWhere('email','=',$email)->firstOrFail();
            $tutorId = $tutor->id;
            $course = new TutoringCourse();
            $course->course_name = $courseName;
            if(trim($CourseDesc)!=''){
                $course->description = $CourseDesc;
            }else{
                $course->description = "";
            }

            $course->owner_id = $tutorId;
            $course->price = $coursePrice;
            $isSaved = $course->save();
            if($isSaved){
                return redirect('/admin/dashboard/myCourses');
            }else{
                echo 'Unable to save new course';
            }


        }else{
            return redirect('/admin');
        }

        // echo $courseName." ".$CourseDesc;
        // if($request->input)

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TutoringCourse  $tutoringCourse
     * @return \Illuminate\Http\Response
     */
    public function show(TutoringCourse $tutoringCourse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TutoringCourse  $tutoringCourse
     * @return \Illuminate\Http\Response
     */
    public function edit(TutoringCourse $tutoringCourse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TutoringCourse  $tutoringCourse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TutoringCourse $tutoringCourse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TutoringCourse  $tutoringCourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(TutoringCourse $tutoringCourse)
    {
        //
    }
}
