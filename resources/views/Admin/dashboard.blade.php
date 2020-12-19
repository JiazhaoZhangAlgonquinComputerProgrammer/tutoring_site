@extends('Admin.layout')
<style type="text/css">
  .tag{
    color: #1e4482 !important;
    font-family: sans-serif;
  }

  .error{
    color: red;
  }
</style>
@section('content')
  <div class="container">
    <div class="row">
      <span class="tag">Edit new article</span>
    </div><br>
    <div class="row">
      <div class="col-md-12">
      <form method="post" action="/admin/post">
        <div class="form-group">
          <label for="articleTitle">Title</label>
          <input type="text" class="form-control" id="articleTitle" name="articleTitle" placeholder="Enter a title of article" required/>
          @if(session('error_title'))
          <p class="error">{{session('error_title')}}</p>
          @endif
        </div>
        <div class="form-group">
          <label for="articleType">Type of article</label>
          <select class="form-control" id="articleType" name="articleType" >
            <option value="technologies">Technologies</option>
            <option value="data_structure">Data Structure</option>
            <option value="personal">Personal</option>
            <option value="other">Other</option>
            <option value="other2">Other2</option>
          </select>
        </div>
        <div class="form-group">
          <label for="articleContent">Edit article here</label>
          <textarea class="form-control" name="articleContent" id="articleContent" rows="9" required></textarea>
        </div>
        @if(session('error_content'))
        <p class="error">{{session('error_content')}}</p>
        @endif
        <button type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;&nbsp;<button type="reset" class="btn btn-danger">Cancel</button>
      </form>
      </div>

    </div>

  </div>
@endsection

@push('otherJS')
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<!-- <script src="{{asset('public/js/ckeditor/ckeditor.js')}}"></script> -->
<script type="text/javascript">
    $(document).ready(function(){
        CKEDITOR.replace( 'articleContent' );
    })

</script>
@endpush
