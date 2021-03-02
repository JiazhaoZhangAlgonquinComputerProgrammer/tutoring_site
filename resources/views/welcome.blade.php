<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Home Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+HK:wght@500&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/2e877829aa.js" crossorigin="anonymous"></script>
        <style type="text/css">
            /* start of style of header */

            /* end of style of header */

            /* start of style of intro section */

            #intro .jumbotron{
                height: 60vh;
            }

            #intro h1{
                font-family: 'Noto Sans HK', sans-serif;
            }

            #header ul li a{
                border: 3px solid #e3d919;
                border-radius: 5px;
            }

            #header ul li a:hover{
                background-color: #e3d919;
                color: black;
            }

            #courses h3{
                text-align: center;
                margin-bottom: 5vh;
            }

            #courses .card h4{
                text-align: center;
                margin-top: 2vh;
            }
            #self-intro{
                margin-top: 10vh;
            }

            #self-intro-left{
                background: url({{url('images/pexels-kaboompics-com-6259.jpg')}});
                height: 60vh;
                background-size: contain;
                background-repeat : no-repeat;
            }

            #self-intro h3{
                margin-bottom: 5vh;
                margin-top: 5vh;
            }

            #footer hr{
                background-color: #e3d919;
                border-color:#e3d919;
                height: 1px;
            }
            #footer{
                margin-bottom: 5vh;
            }
            #footer{
                color: #b0e7f5;
            }
        </style>
    </head>
    <body>

        <!-- header and nav bar -->
        <header id="header">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="/">Tutoring Site</a>
                    {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">求学 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">求职</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">交友</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">其他</a>
                            </li>
                        </ul> --}}

                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="/tutee/register">GET STARTED <span class="sr-only">(current)</span></a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="#">登录</a>
                            </li> --}}
                        </ul>
                    </div>
                </nav>
            </div>

        </header>
        <!-- end of header and nav bar -->

        <!-- hero banner -->
        <section id="intro">
            <div class="jumbotron d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1>Welcome to Tutoring site</h1>
                            <p class="mt-3">Here you will find most trustworthy tutor for computer science</p>
                            <a class="btn btn-warning" href="/tutee/register">GET STARTED</a>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        <!-- end of hero banner -->

        <!-- start of courses section-->
        <section id="courses">
            <h3>Courses for tutoring</h3>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{url('images/web-programming.jpg')}}" style="height:35vh;" class="card-img-top" alt="...">
                            <h4>Java && PHP</h4>
                            <div class="card-body">
                              <p class="card-text">Web app development with Java, J2EE and PHP</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" >
                            <img src="{{url('images/android.jpg')}}" style="height:35vh;" class="card-img-top" alt="...">
                            <h4>Android development (Java)</h4>
                            <div class="card-body">
                              <p class="card-text">Android development or academic projects with Java and Android studio</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" >
                            <img src="{{url('images/algorithm.jpg')}}" style="height:35vh;" class="card-img-top" alt="...">
                            <h4>Data structure and algorithm</h4>
                            <div class="card-body">
                              <p class="card-text">Tutoring in data struture and algorithm with Java, capable of help various leetcode problem from easy to medium</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- end of courses section-->

        <!-- start of self introduction -->
        <section id="self-intro">
            <div class="container">
                <div class="row">
                    <div id="self-intro-left" class="col-md-4 offset-md-1">

                    </div>
                    <div class="col-md-6">
                        <h3>Experienced tutor in computer programming</h4>
                        <p><i class="fas fa-check-circle"></i>&nbsp;Offering more than 300 hours of tutoring</p>
                        <p><i class="fas fa-check-circle"></i>&nbsp;Strong understanding in Java, PHP, JavaScript</p>
                        <p><i class="fas fa-check-circle"></i>&nbsp;Flexible hours and reasonable price</p>
                        <p><i class="fas fa-check-circle"></i>&nbsp;Tutoring in English, Madarin or even Cantonese available</p>
                        <p><i class="fas fa-check-circle"></i>&nbsp;Positive feedbacks from hundreds of students</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of self introduction -->
        <!-- start of footer -->
        <section id="footer">
            <div class="container">
                <div class="row">
                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-3 offset-md-8">
                        <span>2021 All rights reserved</span>
                    </div>
                </div>
            </div>
        </section>
        <!-- end of footer -->
    </body>
</html>
