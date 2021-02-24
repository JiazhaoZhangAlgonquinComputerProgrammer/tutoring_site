<h3>Thank you for booking a tutoring on Tutoring Site<h3>

{{-- {{var_dump($data)}} --}}

<h4>Here are information about your appointment<h4>

<h5>Tutor name : {{$data['tutorName']}}</h5>
<h5>Course : {{$data['course']}}</h5>
<h5>Date : {{$data['date']}}</h5>
<h5>Session timeslots</h5>
@foreach ($data['timeslots'] as $item)
<h5>{{$item['start']}} - {{$item['end']}}</h5>
@endforeach
