@extends('Layouts.main_layout')

@push('otherStyle')
<link rel="stylesheet" href="{{ asset('css/formStyle1.css') }}">
    <style type="text/css">
        .para{
            text-align: center;
            margin-top: 10%;
        }
        .para a{
            text-decoration: none;
        }
    </style>
@endpush

@section('content')
    <div class='form-wrapper'>
        <div>
            <h3 class="register-header">TUTEE LOG IN</h3>
        </div>
        <form action="/tutee/tuteeLogIn" method="POST">
            @csrf
            <label>
              <p class="label-txt">ENTER YOUR EMAIL/USERNAME</p>
              <input type="text" class="input" name="email_username" required>
              <div class="line-box">
                <div class="line"></div>
              </div>
            </label><br>
            {{-- <label>
              <p class="label-txt">ENTER YOUR USERNAME</p>
              <input type="text" class="input" required>
              <div class="line-box">
                <div class="line"></div>
              </div>
            </label><br> --}}
            <label>
              <p class="label-txt">ENTER YOUR PASSWORD</p>
              <input type="password" class="input" name="passwd" required>
              <div class="line-box">
                <div class="line"></div>
              </div>
            </label><br>
            @if (session('user_error'))
                <p class="validation-error">{{session('user_error')}}</p>
            @endif

             <button class="sub-btn" type="submit">submit</button>&nbsp;
             <button class="res-btn" type="reset">Cancel</button><br>

             <p class="para">Dose not have an account? <a href="/tutee/register">Register here</a></p>
             <p class="para">Forget password? Click <a href="#">Password reset</a></p>

          </form>
    </div>
@endsection

@push('otherJS')
    <script type="text/javascript" >
        $(document).ready(function(){

            $('.input').focus(function(){
                $(this).parent().find(".label-txt").addClass('label-active');
            });

            $(".input").focusout(function(){
                if ($(this).val() == '') {
                    $(this).parent().find(".label-txt").removeClass('label-active');
                };
            });

        });
    </script>
@endpush
