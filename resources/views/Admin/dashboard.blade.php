@extends('Admin.layout')
<style type="text/css">
  .tag{
    color: #1e4482 !important;
    font-family: sans-serif;
  }

  .error{
    color: red;
  }

  #info-panel .container{
      padding: 5px;
  }

  #info-panel .row{
      margin-top: 15px;
  }

  #info-panel h6{
      font-family: Arial, Helvetica, sans-serif;
      color: #9ba3a3;
  }

  #info-panel input:focus{
      outline: none;
  }

  #edit-manipulation button{
      display: none;
  }
  #reset-pass-container{
    padding: 15px;
  }

</style>
@section('content')

  <div class="container ">
        <div class="row">
            <div class="col-md-12">
                <h5>Account Information</h5>
                <small style="color: red">@if (session('inValidInfo') )
                    {{session('inValidInfo')}}
                @endif
                @if ( session('notUpdated') )
                    {{session('notUpdated')}}
                @endif
                </small>
            </div>
        </div>
        <div id="info-panel" class="row">
            <div class="col-md-12 border">
                <div class="container">
                    <form action="/tutor/updateAccountInfo" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-warning" id="edit-user">Edit&nbsp;<i class="fas fa-edit"></i></a>
                        </div>
                        <div id="edit-manipulation" class="col-md-3">
                            <button type="submit" class="btn btn-primary">Submit &nbsp;<i class="fas fa-arrow-circle-up"></i></button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger">Cancel&nbsp;<i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Firstname</h6>
                            <input class="border-0" name="firstname" type="text" @if(Session::has('firstname'))value="{{Session::get('firstname')}}" @endif readonly/>
                        </div>
                        <div class="col-md-6">
                            <h6>Lastname</h6>
                            <input class="border-0" name="lastname" type="text" value="@if(Session::has('firstname')) {{Session::get('lastname')}} @endif" readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>School</h6>
                            <input class="border-0" name="school" type="text" value="@if(Session::has('school')) {{Session::get('school')}} @endif" readonly/>
                        </div>
                        <div class="col-md-6">
                            <h6>Company</h6>
                            <input class="border-0" name="company" type="text" value="@if(Session::has('company')) {{Session::get('company')}} @endif" readonly/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Email</h6>
                            {{-- <input class="border-0" type="email" name="email" value="@if(Session::has('email')) {{Session::get('email')}} @endif" readonly/> --}}
                            <span style="color: #053b3b">@if(Session::has('email')) {{Session::get('email')}} @endif</span>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <h5>Reset password</h5>
            </div>
        </div>
        <div class="row">
            <div id="reset-pass-container" class="col-md-12 border">
                <form>
                    <div class="form-group">
                      <label for="newPass">New password</label>
                      <input type="email" class="form-control" id="newPass" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="re-newPass">Confirm new password</label>
                      <input type="password" class="form-control" id="re-newPass">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

  </div>
@endsection

@push('otherJS')
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<!-- <script src="{{asset('public/js/ckeditor/ckeditor.js')}}"></script> -->
<script type="text/javascript">
    $(document).ready(function(){

        var inputs = $('#info-panel').find('input');
            console.log($(inputs));
        var originValues = [];
        for(let i=0;i<inputs.length;i++){
            originValues.push( $(inputs[i]).val() );
        }
        // console.log(originValues)

        $('#edit-user').click(function(){
            // alert('edit user');
            $('#edit-manipulation').find('button').show("slow");
            $('#info-panel').find('input').removeClass('border-0');
            $('#info-panel').find('input').attr("readonly", false);
        })

        $('#edit-manipulation').find('.btn-danger').click(function(){

            $('#edit-manipulation').find('button').hide();
            $('#info-panel').find('input').addClass('border-0');
            $('#info-panel').find('input').attr("readonly", true);
            let i = 0;
            originValues.forEach( e => {
                $(inputs[i]).val(e);
                i++;
            })

        })

    })

</script>
@if (session('isUpdated'))
<script>$(document).ready(function(){alert('Update successfully!!')})</script>
@endif
@endpush
