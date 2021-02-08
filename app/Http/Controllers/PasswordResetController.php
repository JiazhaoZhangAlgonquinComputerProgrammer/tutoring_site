<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PasswordResetController extends Controller
{
    //
    public function resetPasswordPage(){
        return view("PasswordReset.passwordReset");
    }

    public function resetPassword(Request $request){

        if($request->has('email') && $request->has('user_type') ){
            $email = $request->input('email');
            $user_type = $request->input('user_type');
            $token = Str::random(32);
            $url = "http://localhost:8000/setNewPassword?token=".$token;
            try{
                Mail::to($email)->send(new ResetPasswordEmail($url));
            }catch( \Exception $e){
                return json_encode
                (["response"=>"Unable to update password due to fail email",
                    "status"=>500]);
            }

            $tableName = 'tutor_password_resets';
            $emailColumn = 'tutor_email';
            $current_time = Carbon::now()->toDateTimeString();
            $isInserted = false;
            if($user_type == 'tutee'){
                $tableName = 'tutee_password_resets';
                $emailColumn = 'tutee_email';
            }
            try{
                $isInserted = DB::table($tableName)->insert([
                $emailColumn => $email,
                'token' => $token,
                'created_at' => $current_time,
                'updated_at' => $current_time
                ]);
            }catch(\PDOException $e){
                return json_encode
                (["response"=>"Unable to update password due to internal server error ".$e->getMessage(),
                    "status"=>500]);
            }

            if($isInserted){
                return json_encode
                (["response"=>"Hello from the other side ".$email." token : ".$token. " user type:".$user_type ,
                    "status"=>200]);
            }else{
                return json_encode
                (["response"=>"Unable to add new record to database",
                    "status"=>400]);
            }

        }

        return json_encode(["response"=>"Invalid request body","status"=>400]);
    }
}
