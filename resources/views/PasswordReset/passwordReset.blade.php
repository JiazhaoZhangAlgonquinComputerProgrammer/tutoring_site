@extends('Layouts.main_layout')
<style type="text/css">
    #content-wrapper{
        background-color: whitesmoke;
        position: fixed;
        width: 150vh;
        height: 80vh;
        top: 15%;
        left: 50%;
        transform: translateX(-50%)
    }

    #content-wrapper .left{
        width: 60vh;
        /* background-color : blue; */
        background: url({{url('images/use-laptop.jpg')}});
        background-size: contain;
    }

    #content-wrapper .right{
        width: 90vh;

    }

    .spinner-wrapper{
        position: fixed;
        z-index: 999;
        top: 50%;
        left: 50%;
    }
</style>


<div id="progress-spinner" class="spinner-border text-danger spinner-wrapper" role="status">
    <span class="visually-hidden"></span>
</div>

@section('content')

    <div id="content-wrapper" class="d-flex flex-row">
        <div class="left">

        </div>
        <div class="right">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center mt-4">
                        <h4>RESET PASSWORD</h4>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-8 offset-md-2" >
                        <form id="submitResetPass">
                            @csrf
                            <div class="form-group">
                              <label for="email">Email address</label>
                              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                                <label for="user_role">I am a </label>
                                <select class="form-control" id="user_role">
                                  <option value='tutor'>Tutor</option>
                                  <option value='tutee'>Tutee</option>
                                </select>
                              </div>
                            <button type="submit" class="btn btn-primary mr-4">Submit</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

@push('otherJS')
    <script type="text/javascript">
        $(document).ready(function(){

            $( "#progress-spinner" ).hide();

            $( "#submitResetPass" ).submit(function( event ) {
                // alert( "Handler for .submit() called." );
                event.preventDefault();
                $( "#progress-spinner" ).show();
                let theEmail = $(event.target[1]).val();
                let theUserType = $(event.target[2]).val();
                let token = $(event.target[0]).val();
                let host = window.location.origin;
                let url = host+'/resetPassword';
                console.log(url);
                console.log(theEmail);
                console.log(token);
                const data = { email : theEmail, user_type: theUserType }
                console.log(data);
                fetch( url, {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body:JSON.stringify(data)
                }).then( response => response.json())
                .then( (data) => {
                    console.log(data);
                    $( "#progress-spinner" ).hide();
                    if(data.status == 200){
                        alert("Link to reset your password has been sent to your email");
                    }else{
                        alert("Internal server error, unable to send link to your email. Please try again");
                    }
                })

            });

        })
    </script>
@endpush
