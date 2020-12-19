<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index of Admin</title>
  </head>
  <style type="text/css">
    /**background style**/
    body{
      padding: 0;
      margin: 0;
      background: url({{url('images/admin_background.jpg')}})no-repeat;
      background-size: cover;
    }
    .login-form{
      font-family: "Roboto", sans-serif;
      position: relative;
      z-index: 1;
      background: #FFFFFF;
      opacity: 99%;
      max-width: 260px;
      margin: 200px auto 100px;
      padding: 10px 45px 30px 45px;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
      border-radius: 10px;
      font-size: 10px;
    }
    .login-form p{
      font-size: 15px;
      padding: 1px;
      text-align: center;
    }

    .login-form input{
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

    .login-form input:hover{
        background-color: #d5f0ee;
        transition: all 1s ease 0s;
    }

    .login-form input:focus{
        background-color: #d5f0ee;
        transition: all 1s ease 0s;
    }

    .login-form button{
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

    .login-form button:hover, .login-form button:active, .login-form button:focus{
      background-color: #10ada2 ;
      transition: all 1s ease 0s;
    }

    .validation-error{
      font-family: "Roboto", sans-serif;
      color: red;
    }

    .login-form a{
        text-decoration: none;
        color: #0e4bad;
    }

  </style>
  <body>
    <div class="login-form">
      <p>LOG INTO ADMIN SYSTEM</p>
      @if(session('error_message'))
      <p class="validation-error" >{{session('error_message')}}</p>
      @endif
      <form action="/admin/login" method="post">
        <!--{{ csrf_field() }}-->
        <input type="text" name="username" value="" placeholder="USERNAME/EMAIL" required>
        <input type="password" name="passwd" value="" placeholder="PASSWORD" required>
        <button>Log in</button>
      </form>
      <p>Does not have an account ? Start registering to be a tutor <a href="/tutor/registration">here</a> !</p>
    </div>
  </body>
</html>
