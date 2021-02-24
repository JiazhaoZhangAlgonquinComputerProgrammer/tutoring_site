@extends('Admin.layout')

@section('content')
<br>

<div class="container">

    <div class="row">
        <h4>Add your schedual</h4>
    </div><br><br>

    <form action="/timeslot/add" method="POST">
        @csrf
    <div class="form-group row">
        <div class="col-md-2">
            <label for="date-input" class="col-2 col-form-label">Date</label>
        </div>
         <div class="col-md-6">
            <input class="form-control" type="date" value="" name="date-input" id="date-input" required>
        </div>
    </div>
    <br>

    {{-- <div class="form-group row">
        <div class="col-md-2">
            <label for="course-input" class="col-2 col-form-label">Courses</label>
        </div>

         <div class="col-md-6">
            @foreach ($courses as $course)
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="courses[]" value="{{$course->course_name}}">
                    {{$course->course_name}}
                </label>
            </div>
            @endforeach
        </div>
        <div class="col-md-4">
            @if(session('error_course'))
                <p class="validation-error" >{{session('error_course')}}</p>
            @endif
        </div>
    </div> --}}

    <div class="form-group row">
        <div class="col-md-2">
            <label for="timeslot-input" class="col-2 col-form-label">Available TimeSlots</label>
        </div>
        <div class="col-md-3">
            <h6>Morning</h6>
            <hr>
            @for ($i = 0; $i < 4; $i++)
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="timeslots[]" value="{{8+$i}}:00 - {{9+$i}}:00" disabled>
                    {{8+$i}}:00 - {{9+$i}}:00
                </label>
            </div>
            @endfor
        </div>
        <div class="col-md-3">
            <h6>Noon</h6>
            <hr>
            @for ($i = 0; $i < 6; $i++)
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="timeslots[]" value="{{12+$i}}:00 - {{13+$i}}:00" disabled>
                    {{12+$i}}:00 - {{13+$i}}:00
                </label>
            </div>
            @endfor

        </div>

        <div class="col-md-3">
            <h6>Night</h6>
            <hr>
            @for ($i = 0; $i < 4; $i++)
            <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="timeslots[]" value="{{18+$i}}:00 - {{19+$i}}:00" disabled>
                    {{18+$i}}:00 - {{19+$i}}:00
                </label>
            </div>
            @endfor

        </div>
    </div><br>
    @if(session('error_timeslots'))
        <p class="validation-error" >{{session('error_timeslots')}}</p>
    @endif

    {{-- <div class="row">
        <div class="col-md-2">
            <label for="timeslot-input" class="col-2 col-form-label">Price</label>
        </div>
        <div class="col-md-6">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input class="form-control w-25" type="number" value="15" id="price" name="price" required/>
            </div>
        </div>
    </div> --}}
    <br>
    <div class="row">
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">Submit</button> &nbsp;&nbsp;&nbsp;<button type="reset" class="btn btn-warning">Cancel</button>
        </div>
    </div>

    </form>
</div>

@endsection

@push('otherJS')
    <script type="text/javascript">
        $(document).ready(function(){

            var username = '{!! $username !!}';

            $('#date-input').change(function() {
                var date = $(this).val();
                var host = window.location.origin;
                //let url = 'http://awstest01-env.eba-d6463s97.us-east-1.elasticbeanstalk.com/tutor/'+username+'/timeslot/'+date;
                let url = host+'/tutor/'+username+'/timeslot/'+date;
                // alert(url);
                fetch(url).then((response) => response.json())
                          .then( function(data){
                            //   console.log(data[0].start_time);
                                $("input[name='timeslots[]']").attr("disabled", false);

                                data.forEach(tsl => {
                                    let timeSlot = tsl.start_time + " - " + tsl.end_time;
                                    console.log(timeSlot);
                                    $("input[value='"+timeSlot+"']").attr("disabled", true);
                                });

                          });
            })

        })
    </script>
  @endpush
