<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index of Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>
    <style type="text/css">
        /**background style**/
        body{
          padding: 0;
          margin: 0;
          background: url({{url('images/admin_background.jpg')}})no-repeat;
          background-size: cover;
        }

        #login-area .login-form{
          font-family: "Roboto", sans-serif;
          position: relative;
          z-index: 1;
          background: #FFFFFF;
          opacity: 99%;
          max-width: 50vh;
          margin: 100px auto 100px;
          padding: 10px 45px 30px 45px;
          box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
          border-radius: 10px;
          font-size: 10px;
        }
        #login-area .login-form p{
          font-size: 15px;
          padding: 1px;
          text-align: center;
        }

        #login-area .login-form input{
          outline: 0;
          border-radius: 10px;
          background: #d9d5ca;
          width: 100%;
          border: 0;
          margin: 0 0 15px;
          padding: 15px;
          box-sizing: border-box;
          font-size: 13px;
        }

        #login-area .login-form input:hover{
            background-color: #d5f0ee;
            transition: all 1s ease 0s;
        }

        #login-area .login-form input:focus{
            background-color: #d5f0ee;
            transition: all 1s ease 0s;
        }

        #login-area .login-form button{
            text-transform: uppercase;
            outline: 0;
            border-radius: 10px;
            background: #57ebe0 ;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 13px;
            cursor: pointer;
        }

        #login-area .login-form .loginBtn:hover, .login-form .loginBtn:active, .login-form .loginBtn:focus{
          background-color: #10ada2 ;
          transition: all 1s ease 0s;
        }

        #login-area .validation-error{
          font-family: "Roboto", sans-serif;
          color: red;
        }

        #login-area .login-form a{
            text-decoration: none;
            color: #0e4bad;
        }

        #login-area .login-form .resetBtn{
            margin-top: 15px;
            background-color: red;
        }

        #login-area .login-form .resetBtn:hover{
            background-color: #c71212;
            transition: all 1s ease 0s;
        }

        .toggle-link{
            text-decoration: none;
            margin-right: 20px;
            color: #d5f0ee;
        }

        .toggle-link:hover{
            text-decoration: none;
            color: antiquewhite;
        }

      </style>
  </head>

  <body>
      <header id="nav-head">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a href="#" class="navbar-brand">Tutoring Site</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarItems"
                        aria-controls="navbarItems" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-flex flex-row-reverse" id="navbarItems">
                    {{-- <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    </ul> --}}
                    <div class="navbar-nav dropdown customized-dropdown ">
                            <a href="#" class="navbar-link dropdown-toggle dropdown-toggler customized-link toggle-link"
                            id="profileDropdown" role="button" data-toggle="dropdown" >LOG IN</a>
                            <div class="dropdown-menu" aria-labelledby="profileDropdown" >
                                <a href="/admin" class="dropdown-item">LOG IN AS A TUTOR</a>
                                <a href="/tutee/login" class="dropdown-item">LOG IN AS A TUTEE</a>
                            </div>
                        </div>
                    <div class="navbar-nav dropdown customized-dropdown">
                        <a class="navbar-link dropdown-toggle dropdown-toggler customized-link toggle-link"
                        id="profileDropdown" role="button" data-toggle="dropdown">REGISTERATION</a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown" >
                            <a href="/tutor/registration" class="dropdown-item">REGISTER TO BE A TUTOR</a>
                            <a href="/tutee/register" class="dropdown-item">REGISTER TO BE A TUTEE</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
      </header>

    <section id="login-area">
        <div class="login-form">
            <p>LOG INTO AS TUTOR</p>
            @if(session('error_message'))
            <p class="validation-error" >{{session('error_message')}}</p>
            @endif
            <form action="/admin/login" method="post">
                <!--{{ csrf_field() }}-->
                <input type="text" name="username" value="" placeholder="USERNAME/EMAIL" required>
                <input type="password" name="passwd" value="" placeholder="PASSWORD" required>
                <button class="loginBtn">Log in</button>
                <button type="reset" class="resetBtn">Cancel</button>
            </form><br>
            <p>Does not have an account ? Start registering to be a tutor <a href="/tutor/registration">here</a> !</p>
            <p>Forget password? Click <a href="/forgetPassword">here</a> !</p>
        </div>
    </section>

  </body>
</html>
