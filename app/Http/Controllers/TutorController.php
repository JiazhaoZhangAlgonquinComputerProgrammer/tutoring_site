<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutorController extends Controller
{
    //
    public function registration(){
        return view('Tutor.tutor_registration');
    }

    public function registerCourse(Request $request){
        // return view('CourseManagement.register_course');
        if($request->session()->has('username') && $request->session()->has('email')){
          $username = $request->session()->get('username');
          $email = $request->session()->get('email');
          return view('CourseManagement.register_course',['username' => $username, 'email'=>$email]);
        }
    }

    public function showCourses(Request $request){
        if($request->session()->has('username') && $request->session()->has('email')){
          $username = $request->session()->get('username');
          $email = $request->session()->get('email');
          $tutor = Tutor::where('username','=',$username)->orWhere('email','=',$email)->firstOrFail();
          $courses = $tutor->tutoringcourses;
          // dd($courses[0]);
          // var_dump($courses);
          return view('CourseManagement.show_courses',
                        ['username' => $username,
                         'courses' => $courses]);
        }else{
          return redirect('/admin');
        }
    }

    public function addNewTutor(Request $request){
        $email = $request->input("email");
        $username = $request->input("username");
        $passwd = $request->input("passwd");
        $re_passwd = $request->input("re-passwd");
        $firstname = $request->input("firstname");
        $lastname = $request->input("lastname");
        $school = $request->input("school");
        $company = $request->input("company");

        if($passwd!=$re_passwd){
            return back()->with('repass_error','Please confirm your password');
        }else{
            $encryptedPass = Crypt::encrypt($passwd);
            $newtutor = new Tutor();
            $newtutor->username = $username;
            $newtutor->email = $email;
            $newtutor->password = $encryptedPass;
            $newtutor->firstname = $firstname;
            $newtutor->lastname = $lastname;
            $newtutor->school = $school;
            $newtutor->company = $company;

            $isSaved = $newtutor->save();

            if($isSaved){
                $request->session()->put('username',$username);
                $request->session()->put('email',$email);
                return view('Admin.dashboard',['username'=>$username, 'email'=>$email]);
            }else{
                echo 'registration failed';
            }
        }

    }

    public function getCourses($email){

        $courses = DB::table('tutoringcourses')->join('tutors','tutoringcourses.owner_id', '=', 'tutors.id')
                                    ->select('tutoringcourses.*')
                                    ->where('tutors.email','=',$email)
                                    ->get();
        // dd($courses);
        return json_encode($courses);

    }

    public function updateAccountInfo(Request $request){
        // var_dump($request->input('firstname'));

        $newFirtname = $request->input('firstname');
        $newLastname = $request->input('lastname');
        $newSchool = $request->input('school');
        $newCompany = $request->input('company');
        $email = $request->session()->get('email');

        if(trim($newFirtname)=='' || trim($newLastname)=='' || trim($newSchool)=='' || trim($newCompany)==''){
            return back()->with('inValidInfo',"Please provide valid personal information");
        }

        // var_dump($newFirtname." ".$newLastname." ".$newSchool." ".$newCompany." ".$email);
        $updateFields = [
            'firstname' => $newFirtname,
            'lastname' => $newLastname,
            'school' => $newSchool,
            'company' => $newCompany,
        ];
        $returnValue = Tutor::where('email', $email)->update($updateFields);
        if($returnValue == 0){
            echo "Failed to update information";
            return back()->with('notUpdated',"Failed to update your information");
        }else{
            // echo "Update information successfully";
            $request->session()->put('firstname', $newFirtname);
            $request->session()->put('lastname', $newLastname);
            $request->session()->put('school', $newSchool);
            $request->session()->put('company', $newCompany);
            return back()->with('isUpdated',"Your personal information has been renewed");
        }
    }

}
