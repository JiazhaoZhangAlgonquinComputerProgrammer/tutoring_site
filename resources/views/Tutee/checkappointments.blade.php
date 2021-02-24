@extends('Layouts.tutee_dashboard_layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3>My Appointments</h3>
            </div>
        </div><br>
        <div class="row">
            <div class="col-md-2">
                Date
            </div>
            <div class="col-md-2">
                Tutor
            </div>
            <div class="col-md-2">
                Course
            </div>
            <div class="col-md-2">
               Time
            </div>
            {{-- <div class="col-md-2">
                End time
            </div> --}}
            <div class="col-md-10">
                <hr>
            </div>
        </div>


    @if (isset($data)&&count($data)>0)
        {{-- {{var_dump($data[0]->firstname)}} --}}
        @foreach ($data as $item)
        <div class="row">
            <div class="col-md-2">
                {{$item->date}}
            </div>
            <div class="col-md-2">
                {{$item->lastname}}, {{$item->firstname}}
            </div>
            <div class="col-md-2">
                {{$item->course_name}}
            </div>
            <div class="col-md-2">
                {{$item->start_time}}~{{$item->end_time}}
            </div>
            {{-- <div class="col-md-2">
                {{$item->end_time}}
            </div> --}}
            <div class="col-md-10">
                <hr>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
