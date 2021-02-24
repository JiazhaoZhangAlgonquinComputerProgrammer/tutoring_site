@extends('Layouts.main_layout')

@push('otherStyle')
<link rel="stylesheet" href="{{ asset('css/formStyle1.css') }}">
@endpush

@section('content')
    <div class='form-wrapper'>
        <div>
            <h5 class="register-header">REGISTER TO BE A TUTEE</h5>
        </div>
        <form method="POST" action="/tutee/registerNewTutee">
            @csrf
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
            <div style="padding-left: 10%; padding-right:10%;">
                @if (session('error_message'))
                {{-- <p class="validation-error">{{session('error_message')}}</p> --}}
                <div class="alert alert-danger" role="alert">
                    {{session('error_message')}}
                </div>
                @endif
            </div>

             <button class="sub-btn" type="submit">submit</button>&nbsp;
             <button class="res-btn" type="reset">Cancel</button>

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
