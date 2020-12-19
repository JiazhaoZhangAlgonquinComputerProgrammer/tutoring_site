<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
            integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/mainLayout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawsome.all.min.css') }}">
    <script src="{{ asset('js/all.min.js') }}"></script>
    <style>

        .dropdown-toggler{
            text-decoration: none;
            color: #99927f;
        }

        .dropdown-toggler:hover{
            text-decoration: none;
            color: azure;
        }

        .sidebar{
            background:#9e998d;
            display: inline-block;
            position: fixed;
            width: 18%;
            height: 100%;
        }

        .sidebar ul{
            position: relative;
            top: 10%;
            padding: 0;
        }

        .sidebar li{
            line-height: 50px;
            width: 100%;
            text-align: center
            text-decoration: none;
            list-style-type: none;
            padding-left: 30px;
            transition: background-color 0.5s ease;
        }

        .sidebar li:hover{
            background-color:#57585a;
            cursor: pointer;
        }

        .left-content{
            display: inline-block;
            position: relative;
            top:5%;
            left: 20%;
            width: 80%;
            height: 75%;
        }

        .sidebar a{
            text-decoration: none;
            color: azure;
        }
    </style>
    @stack('otherStyle')
    <title>Tutee Dashboard</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a href="#" class="navbar-brand">Tutoring Site</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarItems"
                    aria-controls="navbarItems" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarItems">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                  </li>
                </ul>
                <div class="navbar-nav dropdown">
                    <a href="#" class="navbar-link dropdown-toggle dropdown-toggler"
                        id="profileDropdown" role="button" data-toggle="dropdown">Welcome, {{$username}}</a>
                    <div class="dropdown-menu" aria-labelledby="profileDropdown" >
                        <a href="#" class="dropdown-item">View profile</a>
                        <a href="/tutee/logout" class="dropdown-item">Log out</a>
                    </div>
                </div>
                {{-- <div class="navbar-nav">
                    <a class="nav-item nav-link" href="#">REGISTERATION</a>
                </div> --}}
            </div>
        </div>
    </nav>

    <div class="sidebar">
        <ul>
            <li>
                <a href="/tutee/bookappointment">Book an appointment</a>
            </li>
            <li>
                <a href="/tutee/checkAppointments">Check my appointments</a>
            </li>

        </ul>
    </div>
    <div class="left-content">
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
