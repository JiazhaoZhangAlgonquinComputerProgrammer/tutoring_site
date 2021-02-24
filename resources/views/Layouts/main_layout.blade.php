<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
            integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/mainLayout.css') }}">
    @stack('otherStyle')
    <title>Tutee Log in</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a href="#" class="navbar-brand">Tutoring Site</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarItems"
                    aria-controls="navbarItems" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarItems">
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
                <div class="navbar-nav dropdown customized-dropdown ml-auto">
                        <a href="#" class="navbar-link dropdown-toggle dropdown-toggler customized-link"
                        id="profileDropdown" role="button" data-toggle="dropdown">LOG IN</a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown" >
                            <a href="/admin" class="dropdown-item">LOG IN AS A TUTOR</a>
                            <a href="/tutee/login" class="dropdown-item">LOG IN AS A TUTEE</a>
                        </div>
                </div>
                <div class="navbar-nav dropdown customized-dropdown">
                    <a class="navbar-link dropdown-toggle dropdown-toggler customized-link"
                    id="profileDropdown" role="button" data-toggle="dropdown">REGISTERATION</a>
                    <div class="dropdown-menu" aria-labelledby="profileDropdown" >
                        <a href="/tutor/registration" class="dropdown-item">REGISTER TO BE A TUTOR</a>
                        <a href="/tutee/register" class="dropdown-item">REGISTER TO BE A TUTEE</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
crossorigin="anonymous"></script>
@stack('otherJS')
</html>
