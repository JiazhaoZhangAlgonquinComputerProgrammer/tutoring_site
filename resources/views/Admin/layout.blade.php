<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin Pane</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
            integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
            @stack('otherStyle')
    <style type="text/css">
      .container span{
        font-family: sans-serif;
        color: #d7daf5;
      }

      .dropdown a{
        text-decoration: none;
        font-family: sans-serif;
        color: #807d75;
      }

      .dropdown a:hover{
          color:azure;
      }

      .dropdown-menu a{
        text-decoration: none;
        font-family: sans-serif;
        color:black;
      }

      .dropdown-menu a:hover{
        background: #333942
      }

      .sidebar{
        z-index: 1;
        background: #87888c;
        position: fixed;
        margin-top: 0px;
        width: 250px;
        height: 100%;
        transition: 0.3s;
        transition-property: width;
        overflow-y: auto;
      }
      .sidebar-items{
        margin-top: 50px;
      }
      .sidebar a{
        line-height: 60px;
        padding-left: 40px;
        display: block;
        text-decoration: none;
        width:100%;
        /* color:red; */
        color:#333942;
        box-sizing: border-box;
        transition: 0.5s;
      }

      .sidebar a:hover{
        background: #bec4cf;
        cursor:pointer;
      }

      .main{
        /* background: red; */
        margin-left: 250px;
        margin-top: 10px;
      }

      .sidebar-item-wrapper{
        margin-top: 30px;
      }

      .validation-error{
        color: red;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
    <!-- Navbar content -->
      <div class="container">
        <span class="navbar-brand" >Administration Pane</span>
        <div class="dropdown">
          <a href="#" class="navbar-link dropdown-toggle" id="profileDropdown" role="button" data-toggle="dropdown">Welcome, {{$username}}</a>
          <div class="dropdown-menu" aria-labelledby="profileDropdown" >
            <a href="#" class="dropdown-item">View profile</a>
            <a href="/admin/logout" class="dropdown-item">Log out</a>
          </div>
        </div>
      </div>
    </nav>

    <!-- Side bar -->
    <div class="sidebar">
      <div class="sidebar-item-wrapper">
        <a href="#"><span>Edit New Posts</span></a>
        <a href="/admin/dashboard/registerCourse"><span>Register a course</span></a>
        <a href="/admin/dashboard/myCourses"><span>My Courses</span></a>
        <a href="/admin/dashboard/postmyschedual"><span>Post my timeslots</span></a>
        <a href="/admin/dashboard/displaymytimeslots"><span>View my timeslots</span></a>
        {{-- <a href="/admin/dashboard/displaymyappointments"><span>View my appointments</span></a> --}}
      </div>


    </div>

    <!-- main content -->
    <div class="main">
      @yield('content')
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
              crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
          crossorigin="anonymous"></script>
  @stack('otherJS')
</html>
