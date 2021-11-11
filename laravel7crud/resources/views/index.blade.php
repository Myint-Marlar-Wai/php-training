@extends('layouts.app')
@section('title', 'Student List')
@section('content')
<style>
  .uper,table {
    margin-top: 40px;
  }
</style>
<div class="uper">
  <h1><?php echo $name;?></h1>
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <div class="row">
    <div class="col-3">
      <a href="{{ route('student.create')}}" class="btn btn-primary">Create Student</a>
    </div>
    <div class="col-3">
      <form action="{{ route('student.exportIntoExcel') }}" method="POST">
        @csrf
        <button class="btn btn-success">Download</button>
      </form> 
    </div>
    <div class="col-6">
      <form action="{{ url('/search') }}" method="GET">
        @csrf
        <div class="form-group">
          <input type="search" class="form-control typeahead search-input" name="query" placeholder="Search....."/>
          <button class="btn btn-success" type="submit">Search</button>
      </div>
      </form> 
    </div>

  </div>
  <table class="table">
    <thead class="thead-light">
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Image</th>
          <th>Phone Number</th>
          <th>Address</th>
          <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
      @if($students->count())
        @foreach($students as $student)
        <tr>
            <td>{{$student->id}}</td>
            <td>{{$student->full_name}}</td>
            <td>{{ $student->image }}<img id="original" src="/image/{{ $student->image }}" height="70" width="70"></td>
            <td>{{$student->phone_no}}</td>
            <td>{{$student->address}}</td>
            <td><a href="{{ route('student.edit', $student->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('student.destroy', $student->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
      @endif
    </tbody>
  </table>
  {!! $students->appends(\Request::except('page'))->render() !!}
<div>
@endsection