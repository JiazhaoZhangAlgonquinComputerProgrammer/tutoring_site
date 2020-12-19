@extends('Layouts.main_layout')

@push('otherStyle')
<link rel="stylesheet" href="{{ asset('css/formStyle1.css') }}">
@endpush

@section('content')
    <div class='form-wrapper'>
        <div>
            <h5 class="register-header">REGISTER TO BE A TUTOR</h5>
        </div>
        <form method="POST" action="/tutor/registerNewTutor">
            @csrf
            {{-- form page one --}}
            <div id="formPageOne">
            <label>
              <p class="label-txt">ENTER YOUR EMAIL</p>
              <input type="email" class="input" name="email" required>
              <div class="line-box">
                <div class="line"></div>
              </div>
            </label><br>
            <label>
              <p class="label-txt">ENTER YOUR USERNAME</p>
              <input type="text" class="input" name="username" required>
              <div class="line-box">
                <div class="line"></div>
              </div>
            </label><br>
            <label>
              <p class="label-txt">ENTER YOUR PASSWORD</p>
              <input type="password" class="input" name="passwd" required>
              <div class="line-box">
                <div class="line"></div>
              </div>
            </label><br>
            <label>
                <p class="label-txt">RE-ENTER YOUR PASSWORD</p>
                <input type="password" class="input" name="re-passwd" required>
                <div class="line-box">
                  <div class="line"></div>
                </div>
            </label>
            @if (session('repass_error'))
                <p class="validation-error">{{session('repass_error')}}</p>
            @endif
             <button id="nextFormPage" class="sub-btn" type="button">Next</button>&nbsp;&nbsp;&nbsp;
             <button class="res-btn" type="reset">Cancel</button>
            </div>

            {{-- form page two --}}
            <div id="formPageTwo" style="display: none">
                <label>
                  <p class="label-txt">ENTER YOUR FIRSTNAME</p>
                  <input type="text" class="input" name="firstname" required>
                  <div class="line-box">
                    <div class="line"></div>
                  </div>
                </label><br>
                <label>
                  <p class="label-txt">ENTER YOUR LASTNAME</p>
                  <input type="text" class="input" name="lastname" required>
                  <div class="line-box">
                    <div class="line"></div>
                  </div>
                </label><br>
                <label>
                  <p class="label-txt">ENTER YOUR SCHOOL <span style="font-style: italic;">(optional)</span></p>
                  <input type="text" class="input" name="school" >
                  <div class="line-box">
                    <div class="line"></div>
                  </div>
                </label><br>
                <label>
                    <p class="label-txt">RE-ENTER YOUR COMPANY <span style="font-style: italic;">(optional)</span></p>
                    <input type="text" class="input" name="company" >
                    <div class="line-box">
                      <div class="line"></div>
                    </div>
                </label>
                @if (session('repass_error'))
                    <p class="validation-error">{{session('repass_error')}}</p>
                @endif
                 <button id="submitForm" class="sub-btn" type="submit">Submit</button>&nbsp;&nbsp
                 <button id="goBack" class="res-btn" type="button">Back</button>&nbsp;&nbsp
                 <button class="res-btn" type="reset">Cancel</button>
                </div>

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

            $('#nextFormPage').click(function(){
                $('#formPageOne').hide();
                $('#formPageTwo').show();
            })

            $('#goBack').click(function(){
                $('#formPageOne').show();
                $('#formPageTwo').hide();
            })

        });
    </script>
@endpush
