@extends('Admin.layout')

@push('otherStyle')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
@endpush

@section('content')
  <br>
  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5>My courses</h5><br>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <table id="courses_table">

                <thead>
                    <tr>
                        <td>Course name</td>
                        <td>Course description</td>
                        <td>price ($ / hour)</td>
                        <td>Management</td>
                    </tr>

                </thead>

                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->course_name }}</td>
                            <td>{{ $course->description }}</td>
                            <td>{{ $course->price }}</td>
                            <td><a href="#" class="btn btn-primary">update</a> &nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-danger">delete</a></td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>


  </div>

  @endsection

  @push('otherJS')
    <script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#courses_table').DataTable();

        })
    </script>
  @endpush
