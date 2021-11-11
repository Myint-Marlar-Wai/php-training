@extends('layouts.app')
@section('title', 'Create Student')
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>

<div class="card uper">
  <div class="card-header">
    <h1><?php echo $name;?></h1>
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('student.store') }}" enctype="multipart/form-data">
        @csrf
          <div class="form-group">
              <label for="full_name">Full Name:</label>
              <input type="text" class="form-control" name="full_name"/>
          </div>
          <div class="form-group">
            <label for="image">Choose Image:</label>
            <input type="file" class="form-control" name="image" onChange="previewFile()" />
            <img id="previewImg" src="/image/demo.png" alt="Profile Image" style="max-width:130px;margin-top:20px;" />
          </div>
          <div class="form-group">
              <label for="phone_no">Phone Nubmer:</label>
              <input type="text" class="form-control" name="phone_no"/>
          </div>
          <div class="form-group">
              <label for="address">Address :</label>
              <textarea rows="5" columns="5" class="form-control" name="address"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Add Student</button>
      </form>
  </div>
</div>
<script>
  function previewFile(input) {
    var file = $("input[type=file]").get(0).files[0];
    if(file) {
      var reader = new FileReader();
      reader.onload = function() {
        $("#previewImg").attr("src",reader.result);
      }
      reader.readAsDataURL(file);
    }
  }
</script>
@endsection