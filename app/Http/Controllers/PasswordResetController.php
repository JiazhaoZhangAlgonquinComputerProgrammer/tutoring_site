<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    //
    public function resetPasswordPage(){
        return view("PasswordReset.passwordReset");
    }
}
