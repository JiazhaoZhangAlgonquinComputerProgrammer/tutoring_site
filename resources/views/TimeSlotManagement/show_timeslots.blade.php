@extends('Admin.layout')

@section('content')
<br>

<div class="container">

    <div class="row">
        <div class="col-md-4">
            <h3>My timeslots</h3>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-6">
            <form class="form-group" action="/timeslot/find" method="POST">
                @csrf
                <input class="form-control" type="date" value="" name="date-input" id="date-input" required><br>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        @if (session('error_message'))
        <div class="col-md-6">
            <p style="color:red;">{{session('error_message')}}</p>
        </div>
        @endif
    </div>

    <br>

    <div class="row">
        {{-- <div class="col-md-2">
            <h6>Date</h6>
        </div> --}}
        <div class="col-md-2">
            <h6>Start time</h6>
        </div>
        <div class="col-md-2">
            <h6>End time</h6>
        </div>
        <div class="col-md-2">
            <h6>Book by</h6>
        </div>
        <div class="col-md-2">
            <h6>Course</h6>
        </div>
        <div class="col-md-2">
            <h6>Management</h6>
        </div>
    </div>
    <hr>

    @foreach ($existingTimeSlots as $item)
    <div class="row" style="margin-top: 15px;">
        {{-- <div class="col-md-2">
            <h6>{{$item->date}}</h6>
        </div> --}}
        <div class="col-md-2">
            <h6>{{$item->start_time}}</h6>
        </div>
        <div class="col-md-2">
            <h6>{{$item->end_time}}</h6>
        </div>
        <div class="col-md-2">
            <h6>{{$item->tutee_name}}</h6>
        </div>
        <div class="col-md-2">
            <h6>{{$item->course_name}}</h6>
        </div>
        <div class="col-md-2">
            <a class="btn btn-danger" href="#">Delete</a>&nbsp;
            @if ($item->isBooked == 1)
            <a class="btn btn-warning" href="#">Decline</a>
            @endif
        </div>
    </div>
    @endforeach

</div>
@endsection
