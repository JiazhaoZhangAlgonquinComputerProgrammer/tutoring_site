@extends('Admin.layout')

@section('content')
  <br>
  <div class="container">
    <div class="row">
      <h4>register a course</h4>
    </div>

    <div class="row">
      <div class="col-md-10">
        <form action="/course/add" method="post">
           @csrf
          <div class="form-group">
            <label for="courseName">Course Name</label>
            <input type="text" class="form-control" name="courseName" id="courseName" required>
          </div>
          <div class="form-group">
            <label for="course_desc">Description</label>
            <textarea type="text" class="form-control" name="course_desc" id="course_desc" rows="8"
              placeholder="Why not let people know what you know about this subject" >
            </textarea>
          </div>
          <div class="row">
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
        </div><br>
          <button type="submit" class="btn btn-primary">Submit</button> &nbsp;&nbsp;&nbsp;
          <button type="reset" class="btn btn-warning">Reset</button>
        </form>
      </div>
    </div>
  </div>
  @endsection
