<?php

namespace App\Http\Controllers;

use App\Models\TimeSlot;
use App\Models\TutoringCourse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tutor;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

class TimeSlotController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('username') && $request->session()->has('email')){
            $username = $request->session()->get('username');
            $email = $request->session()->get('email');
            $tutor = Tutor::where('username','=',$username)->orWhere('email','=',$email)->firstOrFail();
            // $userId = $user->id;
            // $existingTimeSlots = TimeSlot::where('owner_id', '=', $userId)->get();
            $courses = $tutor->tutoringcourses;
            // dd($existingTimeSlots[0]->start_time);
            // var_dump($courses[0]->description);
            return view("TimeSlotManagement.add_timeslot",['courses' => $courses,
                                                            'username' => $username]);
          }else{
            return redirect('/admin');
        }
        // echo "Post my schedual";

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
        if($request->session()->has('username') && $request->session()->has('email')){
            $username = $request->session()->get('username');
            $username = $request->session()->get('username');
            $email = $request->session()->get('email');
            $tutor = Tutor::where('username','=',$username)->orWhere('email','=',$email)->firstOrFail();
            $tutorId = $tutor->id;
        }else{
            return redirect('admin/index');
        }

        if($request->has("timeslots") && $request->input("timeslots")!=null){
            $timeslots = $request->input("timeslots");

        }else{
            return back()->with('error_timeslots','Please select time slots you would like to tutor');
        }

        $date = $request->input("date-input");
        // $price = $request->input("price");

        DB::transaction(function () use ($tutorId, $date, $timeslots){
            for($i=0;$i<count($timeslots);$i++){
                $timeArr = explode (" - ",$timeslots[$i]);
                $start = $timeArr[0];
                $end = $timeArr[1];
                $tl = new TimeSlot();
                $tl->owner_id = $tutorId;
                $tl->date = $date;
                $tl->start_time = $start;
                $tl->end_time = $end;
                // $tl->price_per_hour = $price;
                $tl->isBooked = false;
                $tl->save();
            }

        });

        // dd(explode (" - ",$timeslots[0]));
        // var_dump($coursesResult[0]->course_name);
        return redirect('/admin/dashboard/displaymytimeslots');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeSlot  $timeSlot
     * @return \Illuminate\Http\Response
     */
    public function show(TimeSlot $timeSlot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeSlot  $timeSlot
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeSlot $timeSlot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimeSlot  $timeSlot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeSlot $timeSlot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeSlot  $timeSlot
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeSlot $timeSlot)
    {
        //
    }

    public function getTutorTimeSlotsByDate($username, $date){
        $tutor = Tutor::where('username','=',$username)->firstOrFail();
        $tutorId = $tutor->id;
        $matches = [
            ['owner_id', '=', $tutorId],
            ['date', '=', $date ]
        ];

        $existingTimeSlots = TimeSlot::where($matches)->get();
        // $resultArray = [];
        // // dd($existingTimeSlots[0]->start_time);
        // for($i=0;$i<count($existingTimeSlots);$i++){
        //     array_push($resultArray, $existingTimeSlots[0]);
        // }
        return json_encode($existingTimeSlots);
    }

    public function getTutorAvailableTimeSlotsByDate($email, $date){
        $tutor = Tutor::where('email','=',$email)->firstOrFail();
        $tutorId = $tutor->id;
        $matches = [
            ['owner_id', '=', $tutorId],
            ['date', '=', $date],
            ['isBooked', '=', 0]
        ];

        $availableTimeSlots = TimeSlot::where($matches)->get();
        // $resultArray = [];
        // // dd($existingTimeSlots[0]->start_time);
        // for($i=0;$i<count($existingTimeSlots);$i++){
        //     array_push($resultArray, $existingTimeSlots[0]);
        // }
        return json_encode($availableTimeSlots);
    }

    public function showAllTimeSlots(Request $request){

        if($request->session()->has('username') && $request->session()->has('email')){
            $username = $request->session()->get('username');
            $email = $request->session()->get('email');
            // $user = User::where('name','=',$username)->firstOrFail();
            // $userId = $user->id;

            // $matches = [
            //     ['owner_id', '=', $userId]
            // ];

            // $existingTimeSlots = TimeSlot::where($matches)->get();
            $existingTimeSlots = [];
            // dd($existingTimeSlots);

            return view("TimeSlotManagement.show_timeslots",['username' => $username, 'existingTimeSlots'=>$existingTimeSlots]);

          }else{
            return redirect('/admin');
          }

    }

    public function findTimeSlotsByUserAndDate(Request $request){

        if($request->session()->has('username') && $request->session()->has('email')){
            if($request->has('date-input')){
                $username = $request->session()->get('username');
                $email = $request->session()->get('email');
                $tutor = Tutor::where('username','=',$username)->orWhere('email','=',$email)->firstOrFail();
                $tutorId = $tutor->id;
                $date = $request->input('date-input');
                $matches = [
                    ['timeslots.owner_id', '=', $tutorId],
                    ['timeslots.date', '=', $date ]
                ];

                // $existingTimeSlots = TimeSlot::where($matches)->get();
                $existingTimeSlots = DB::table('timeslots')
                                        ->leftJoin('appointments','timeslots.id','=','appointments.timeslot_id')
                                        ->leftJoin('tutees','appointments.tutee_id','=','tutees.id')
                                        ->leftJoin('tutoringcourses','appointments.course_id','=','tutoringcourses.id')
                                        ->where($matches)
                                        ->get([
                                            'timeslots.start_time',
                                            'timeslots.end_time',
                                            'tutoringcourses.course_name',
                                            'tutees.username as tutee_name',
                                            'timeslots.isBooked']);
                // dd($existingTimeSlots);
                return view("TimeSlotManagement.show_timeslots",['username' => $username, 'existingTimeSlots' =>$existingTimeSlots]);
            }else{
                return back()->with('error_message','Please select the date you would like to view your schedual');
            }

        }else{
            return "No user session found";
        }
    }

}
