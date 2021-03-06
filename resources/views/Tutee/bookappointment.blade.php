@extends('Layouts.tutee_dashboard_layout')
@push('otherStyle')
<style type="text/css">
  .toggle-search{
      text-decoration: none;
      color: #4c17c2;
  }

  .toggle-search:hover{
      text-decoration: none;
  }
</style>
@endpush
@section('content')
    <div class="container">
        <!-- Start of section of searching by course-->
        @if (isset($searchBy) && $searchBy == 'course')
        <div class="row">
            <div class='col-md-8'>
                <h4><a class="toggle-search" href="/tutee/bookappointment">Search for a tutor</a> / Search for a course</h4>
            </div>
       </div><br>
       <div class="row">
            <div class="col-md-6">
                <form action="/tutee/bookappointment" method="POST">
                    @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="searchCourse" placeholder="Search for a course" required>
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                </form>
            </div>
       </div>
       <!-- end of section of searching by course-->
        @else
        <!-- Start of section of searching by tutor-->
        <div class="row">
            <div class='col-md-8'>
                <h4>Search for a tutor / <a class="toggle-search" href="/tutee/bookappointment?searchBy=course">Search for a course</a></h4>
            </div>
       </div><br>
       <div class="row">
            <div class="col-md-6">
                <form action="/tutee/bookappointment" method="POST">
                    @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="searchTutor" placeholder="Search for a tutor" required>
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                </form>
            </div>
       </div>
       <!-- end of section of searching by course-->
        @endif

    <!-- search result of tutors -->
       @if (isset($tutors))
        <div class="row">
           @if (count($tutors)>0)
           <div class="col-4">
              <div class="list-group" id="list-tab" role="tablist">
                @php ($i = 1)
                @foreach ($tutors as $tutor)
                <a class="list-group-item list-group-item-action"
                id="list-tutor-{{$i}}" tutorEmail="{{$tutor->email}}" name="tutor-link" data-toggle="list" href="#list-{{$i}}"
                role="tab" aria-controls="home">{{$tutor->lastname.', '.$tutor->firstname}}</a>
                @php ($i++)
                @endforeach
                </div>
           </div>

            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                    @php ($j = 1)
                    @foreach ($tutors as $tutor)
                    <div class="tab-pane fade" id="list-{{$j}}" role="tabpanel" aria-labelledby="list-home-list">
                        <p>Email : {{$tutor->email}}</p>
                        <p>School : {{$tutor->school}}</p>
                        <p>Company : {{$tutor->company}}</p>
                        <form action="/tutee/submitbooking" method="POST">
                            @csrf
                            <div class="form-group">
                                 <input type="text" name="email" value="{{$tutor->email}}" hidden/>
                                 <input type="text" name="tutor_id" value="{{$tutor->id}}" hidden/>
                                 <p>Tutoring courses : </p>
                                <select class="form-control w-50" name="coursesWrapper">

                                </select><br>
                                <p>Available hours:</p>
                                <input class="form-control w-50" type="date" tutorEmail="{{$tutor->email}}" value="" name="date-input" required/>
                            </div>
                            <div class="form-group" style="display: none" name="timeslotWrapper">
                            </div><br>
                            <button type="submit" class="btn btn-primary">Book it </button>&nbsp;
                            <button type="reset" class="btn btn-warning">Cancel</button>
                        </form>

                    </div>
                    @php ($j++)
                    @endforeach

                </div>
            </div>
            @else
            {{-- <p style="color: red"> Sorry, we could not find any records about this tutor</p> --}}

                <div class="col-8">
                    <div class="alert alert-danger">
                        Sorry, we could not find any records about this tutor
                    </div>
                </div>
            @endif
        </div>
       @endif
    <!-- end of search result of tutors -->
    <br>
    <!-- search result of courses -->
    @if (isset($courses))
        @if(count($courses)>0)
            {{-- {{var_dump($courses)}} --}}
            <div class="row">
                <div class="col-md-2">
                    Course name
                </div>
                <div class="col-md-3">
                    Course description
                </div>
                <div class="col-md-2">
                    Course Price
                </div>
                <div class="col-md-2">
                    Tutor name
                </div>
            </div>
            <hr>
            @foreach ($courses as $course)
            <div class="row">
                <div class="col-md-2">
                    {{$course->course_name}}
                </div>
                <div class="col-md-3">
                    {{$course->description}}
                </div>
                <div class="col-md-2">
                    ${{$course->price}} / hour
                </div>
                <div class="col-md-2">
                    {{$course->lastname}}, {{$course->firstname}}
                </div>
            </div>
            @endforeach
            <hr>
            <div class="row">
                @if ($page>1)
                <div class="col-md-1">
                    <a href="/tutee/bookappointment?page={{$page<=1?1:$page-1}}&&moveTo=prev&&searchCourse={{$searchCourse}}" class="btn btn-primary">Previous</a>
                </div>
                @endif
                @if ($more)
                <div class="col-md-1">
                    <a href="/tutee/bookappointment?page={{$page+1}}&&moveTo=next&&searchCourse={{$searchCourse}}" class="btn btn-primary">Next</a>
                </div>
                @endif

            </div>
        @else
            <div class="row">
                <div class="col-md-8">
                    <span class=" alert alert-danger">No record of this course found</span>
                </div>

            </div>
        @endif


    @endif
    <!-- end of search result of tutors -->

       @if (session('error_message'))
            {{-- <p class="validation-error">Error : {{session('error_message')}}</p> --}}
            <div class="alert alert-danger">
                Error : {{session('error_message')}}
            </div>
        @endif
    </div>
@endsection

@push('otherJS')
    <script type="text/javascript">
        $(document).ready(function(){

            var username = '{!! $username !!}';
            var host = window.location.origin;

            $("a[name='tutor-link']").click(function() {
                let email = $(this).attr('tutorEmail');
                // alert("Tutor link "+email);
                // let url = 'http://localhost:8000/tutor/'+email+'/courses';
                let url = host+'/tutor/'+email+'/courses';
                fetch(url).then((response) => response.json())
                        .then(function(data){
                            console.log(data);
                            $("div[name='timeslotWrapper']").hide();
                            $("div[name='timeslotWrapper']").empty();
                            $("input[name='date-input']").val('');
                            $("select[name='coursesWrapper']").empty();
                            data.forEach(element => {
                                $("select[name='coursesWrapper']").
                                append("<option value='"+element.id+"' >"+element.course_name+"  (price: $"+element.price+"/hr)</option>");
                            });

                        }).catch(error => {
                            console.error('Error:', error);
                        })
            });

            $("input[name='date-input']").change(function(){
                let date = $(this).val();
                let email = $(this).attr('tutorEmail');
                // let host = window.location.origin;
                // let url = 'http://localhost:8000/tutor/'+email+'/availabletimeslot/'+date;
                let url = host+'/tutor/'+email+'/availabletimeslot/'+date;
                // alert("data is "+date+" email: "+email);
                fetch(url).then((response) => response.json())
                        .then(function(data){
                            // let divId = '#timeslotWrapper-'+email;
                            $("div[name='timeslotWrapper']").empty();
                            data.forEach(element=>{
                                let timeSlotId = element.id;
                                let timeRange = element.start_time+'~'+element.end_time;
                                // alert(timeSlotId+" : "+timeRange);

                                $("div[name='timeslotWrapper']").
                                    append("<input type='checkbox' name='availableSlots[]' value='"+timeSlotId+"' />&nbsp;"+timeRange+"<br>");
                            });
                            $("div[name='timeslotWrapper']").show();
                            console.log(data);
                        }).catch(error => {
                            console.error('Error:', error);
                        })
            });

        })
    </script>
  @endpush
