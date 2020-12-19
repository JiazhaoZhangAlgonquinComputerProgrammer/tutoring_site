<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\TimeSlot;
use App\Models\Tutee;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Mail\AppointmentMail;
use App\Models\TutoringCourse;
use Illuminate\Support\Facades\Mail;

class TuteeController extends Controller
{

    public function register(){
        return view("Tutee.register");
    }

    public function login(){
        return view("Tutee.login");
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
        $passwd = $request->input("passwd");
        $repasswd = $request->input("re-passwd");
        if($passwd==''||$repasswd==''||$passwd!=$repasswd){
            return back()->with('error_message','Passwords not match');
        }
        $results = DB::table('tutees')->where('email','=',$request->input("email"))
                                    ->orWhere('username','=',$request->input("username"))
                                    ->get();
        // var_dump($results);
        if(count($results)>0){
            return back()->with('error_message','The username or email has been registered');
            // echo 'user exists';
        }

        try{
            $encryptedPass = Crypt::encrypt($passwd);
            $newTutee = new Tutee();
            $newTutee->username = $request->input("username");
            $newTutee->email = $request->input("email");
            $newTutee->password = $encryptedPass;
            $isSaved = $newTutee->save();
            if($isSaved){
                $theTutee = Tutee::where('email','=',$request->input("email"))->first();
                $request->session()->put('tutee_username', $theTutee->username);
                $request->session()->put('tutee_email', $theTutee->email);
                $request->session()->put('tutee_id', $theTutee->id);

                return redirect('/tutee/dashboard');
            }else{
                return "failed to register a user";
            }
        }catch( \PDOException $e ){
            // echo $e;
            return back()->with('error_message','Database internal error');
        }

    }

    public function tuteeLogIn(Request $request){

        $username_or_email = $request->input('email_username');
        $password = $request->input('passwd');
        $tutee = DB::table('tutees')
                    ->where('username', '=', $username_or_email)
                    ->orWhere('email', '=', $username_or_email)
                    ->get();
        if(count($tutee)<=0){
            return back()->with('user_error','User does not exist');
        }
        $expectedPass = Crypt::decrypt($tutee[0]->password);

        if($password == $expectedPass){
            // echo "log in successfully<br>";
            // echo $expectedPass. ' '. $password;
            //add redirect to tutee panel
            $request->session()->put('tutee_username', $tutee[0]->username);
            $request->session()->put('tutee_email', $tutee[0]->email);
            $request->session()->put('tutee_id', $tutee[0]->id);
            return redirect('/tutee/dashboard');

        }else{
            return back()->with('user_error','Wrong password, please log in again');
        }

    }

    public function dashboard(Request $request){
        if($request->session()->has('tutee_username') &&  $request->session()->has('tutee_email')){

            $username = $request->session()->get('tutee_username');
            $email = $request->session()->get('tutee_email');
            return view("Tutee.tutee_dashboard", ['username'=>$username, 'email'=>$email]);
        }else{
            return redirect('/tutee/login');
        }
    }

    public function bookappointment(Request $request){
        if($request->session()->has('tutee_username') &&  $request->session()->has('tutee_email')){
            $username = $request->session()->get('tutee_username');
            $email = $request->session()->get('tutee_email');
            if($request->input("searchTutor")){
                $searchTutor = $request->input("searchTutor");
                //TODO : Finish code for finding a tutor by name
                $tutors = DB::table('tutors')
                        ->select()
                        ->where('tutors.firstname','like','%'.$searchTutor.'%')
                        ->orWhere('tutors.lastname','like','%'.$searchTutor.'%')
                        // ->orWhere('tutors.username','like','%'.$searchTutor.'%')
                        ->get();
                // dd($tutors);
                return view("Tutee.bookappointment",
                            ['username'=>$username,
                            'email'=>$email,
                            'tutors'=>$tutors]);
            }else{
                return view("Tutee.bookappointment", ['username'=>$username, 'email'=>$email]);
            }

        }else{
            return redirect('/tutee/login');
        }
    }

    public function findTutors(Request $request){

        if($request->has('searchTutor')){
            $searchTutor = $request->get('searchTutor');
            $results = DB::table('tutors')->leftJoin('tutoringcourses','tutors.id','=','tutoringcourses.owner_id')
                ->select()
                ->where('tutors.firstname','like','%'.$searchTutor.'%')
                ->orWhere('tutors.lastname','like','%'.$searchTutor.'%')
                ->orWhere('tutors.username','like','%'.$searchTutor.'%')
                ->get();
            dd($results);
        }

    }

    public function logout(Request $request){
        if($request->session()->has('tutee_username')
            &&$request->session()->has('tutee_email')
            &&$request->session()->has('tutee_id')){

            $request->session()->forget('tutee_username');
            $request->session()->forget('tutee_email');
            $request->session()->forget('tutee_id');
            $request->session()->flush();

        }
        return redirect('/tutee/login');
    }

    public function handleBooking(Request $request){

        if($request->session()->has('tutee_username')
            &&$request->session()->has('tutee_email')
            &&$request->session()->has('tutee_id')){
            if($request->input('availableSlots')==null || count($request->input('availableSlots'))<=0){
                return back()->with('error_message','Please select the timeslots you would like to book');
            }

            $email = $request->input('email');
            $tutor_id = $request->input('tutor_id');
            $course = $request->input('coursesWrapper');
            $date = $request->input('date-input');
            $availableSlots = $request->input('availableSlots');
            $tuteeEmail = $request->session()->get('tutee_email');
            $tutee_id = $request->session()->get('tutee_id');

            if($course==''||$course==null){
                return back()->with('error_message','Please select the course you would like to book');
            }
            // return 'handle booking';
            // echo $email.'<br>';
            // echo 'Course:'.$course.'<br>';
            // echo $date.'<br>';
            // echo $tuteeEmail.'<br>';
            // echo $tutor_id.'<br>';
            // echo $tutee_id.'<br>';
            // var_dump($availableSlots);

            // $returnValue = DB::transaction(function () use ($availableSlots,$tutor_id,$tutee_id,$course){

            //     foreach($availableSlots as $availableSlot){

            //         $appointment = new Appointment();
            //         $appointment->tutor_id = $tutor_id;
            //         $appointment->tutee_id = $tutee_id;
            //         $appointment->course_id = $course;
            //         $appointment->timeslot_id = $availableSlot;
            //         $appointment->save();
            //         $timeSlot = TimeSlot::find($availableSlot);
            //         $timeSlot->isBooked=true;
            //         $timeSlot->save();

            //     }

            // });

            // var_dump($returnValue);
            try {
                DB::beginTransaction();
                // database queries here
                $timeSlotsBooked = [];
                foreach($availableSlots as $availableSlot){

                    $appointment = new Appointment();
                    $appointment->tutor_id = $tutor_id;
                    $appointment->tutee_id = $tutee_id;
                    $appointment->course_id = $course;
                    $appointment->timeslot_id = $availableSlot;
                    $appointment->save();
                    $timeSlot = TimeSlot::find($availableSlot);
                    $timeSlotArr = ['start'=>$timeSlot->start_time,'end'=>$timeSlot->end_time];
                    array_push($timeSlotsBooked,$timeSlotArr);
                    $timeSlot->isBooked=true;
                    $timeSlot->save();
                }
                DB::commit();
                $tutor = Tutor::find($tutor_id);
                $theCourse = TutoringCourse::find($course);
                Mail::to($tuteeEmail)->send(new AppointmentMail([
                    'tutorName'=>$tutor->lastname.', '.$tutor->firstname,
                    'date' => $date,
                    'course' => $theCourse->course_name,
                    'timeslots'=>$timeSlotsBooked
                ],1));
                Mail::to($email)->send(new AppointmentMail([
                    'tuteeEmail'=>$tuteeEmail,
                    'date' => $date,
                    'course' => $theCourse->course_name,
                    'timeslots'=>$timeSlotsBooked
                ],2));
            } catch (\PDOException $e) {
                DB::rollBack();
                echo $e;
                return "Unable to save data to database, all transactions are rollbacked";
            }
            return redirect('/tutee/checkAppointments');
        }else{
            return redirect('/tutee/login');
        }

    }

    public function checkAppointments(Request $request){

        if($request->session()->has('tutee_username')
            &&$request->session()->has('tutee_email')
            &&$request->session()->has('tutee_id')){

            $username = $request->session()->get('tutee_username');
            $email = $request->session()->get('tutee_email');

            try{

                $results = DB::table('tutees')->join('appointments','tutees.id','=','appointments.tutee_id')
                                ->join('tutors','tutors.id','=','appointments.tutor_id')
                                ->join('tutoringcourses','tutoringcourses.id','=','appointments.course_id')
                                ->join('timeslots','timeslots.id','=','appointments.timeslot_id')
                                ->select(['tutors.firstname',
                                            'tutors.lastname',
                                            'timeslots.start_time',
                                            'timeslots.end_time',
                                            'timeslots.date',
                                            'tutoringcourses.course_name'])
                                ->where('tutees.id','=',$request->session()->get('tutee_id'))
                                ->get();
                // dd($results);

            }catch(\PDOException $e){
                return "Database connection error ...";
            }

            return view('Tutee.checkappointments',['username'=>$username, 'email'=>$email, 'data'=>$results]);

        }else{
            return redirect('/');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tutee  $tutee
     * @return \Illuminate\Http\Response
     */
    public function show(Tutee $tutee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tutee  $tutee
     * @return \Illuminate\Http\Response
     */
    public function edit(Tutee $tutee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tutee  $tutee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tutee $tutee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tutee  $tutee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutee $tutee)
    {
        //
    }
}
