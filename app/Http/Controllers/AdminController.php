<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    //
    public function index(Request $request){
      // return "Hello from Admin:index ";
      if($request->session()->has('username')){
          $request->session()->forget('username');
          $request->session()->flush();
      }
      return view('Admin.index');
    }

    public function register(){
      return "Hello from Admin:register ";
    }

    public function logout(Request $request){

      if($request->session()->has('username')){
          $request->session()->forget('username');
          $request->session()->flush();
      }
      return view('Admin.index');

    }

    public function dashboard(Request $request){
      if($request->session()->has('username') && $request->session()->has('email')){
        $username = $request->session()->get('username');
        $email = $request->session()->get('email');
        return view('Admin.dashboard',['username' => $username, 'email'=>$email]);
      }else{
        return redirect('admin/index');
      }
    }

    public function login(Request $request){
        // return view('Admin.index');

        // dd($request->all()['username']);
        // dd($request->all()['passwd']);
        $username = $request->all()['username'];
        $passwd = $request->all()['passwd'];
        // $user = User::where($matchThese)->get();
        $tutor = Tutor::where('username', '=', $username)
                        ->orWhere('email', '=', $username)
                        ->get();
        // var_dump(Crypt::decrypt($tutor[0]->password));


        if(count($tutor)<=0){
          return back()->with('error_message','Tutor not exist');
        }
        $expectedName = $tutor[0]->username;
        $expectedPass = $tutor[0]->password;
        $expectedEmail = $tutor[0]->email;
        try {
            $expectedPass = Crypt::decrypt($expectedPass);
        } catch (DecryptException $e) {
            //
            return back()->with('error_message',"Invalid password");
        }
        if($passwd==$expectedPass){
          $request->session()->put('username', $expectedName);
          $request->session()->put('email', $expectedEmail);
          $request->session()->put('firstname', $tutor[0]->firstname);
          $request->session()->put('lastname', $tutor[0]->lastname);
          $request->session()->put('school', $tutor[0]->school);
          $request->session()->put('company', $tutor[0]->company);
          return redirect('admin/dashboard');
        }else{
          return back()->with('error_message',"Invalid username or password");
        }
        // var_dump($user[0]['name']);
    }
}
