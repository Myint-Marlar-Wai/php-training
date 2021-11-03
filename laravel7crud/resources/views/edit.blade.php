@extends('layout')
@section('title', 'Edit Student')
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
      <form method="post" action="{{ route('student.update', $student->id ) }}">
          <div class="form-group">
              @csrf
              <label for="full_name">Full Name:</label>
              <input type="text" class="form-control" name="full_name" value="{{ $student->full_name }}"/>
          </div>
          <div class="form-group">
              <label for="phone_no">Phone Nubmer:</label>
              <input type="text" class="form-control" name="phone_no" value="{{ $student->phone_no }}"/>
          </div>
          <div class="form-group">
              <label for="address">Address :</label>
              <textarea rows="5" columns="5" class="form-control" name="address">{{ $student->address }}</textarea>
          </div>
          <button type="submit" class="btn btn-primary">Update Data</button>
      </form>
  </div>
</div>
@endsection