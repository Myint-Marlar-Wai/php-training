@extends('layouts.app')
@section('title', 'Search Results')
@section('content')
<style>
  .uper,table {
    margin-top: 40px;
  }
  .search-input {
    width: 200px;
    float: left;
  }
</style>
<div class="uper">
  <h1>Search Results</h1>
  <div class="row">
    <div class="col-3">
      <a href="{{ route('student.create')}}" class="btn btn-primary">Create Student</a>
    </div>
    <div class="col-3">
      <form action="{{ route('student.exportIntoExcel') }}" method="POST">
        <button class="btn btn-success">Download</button>
      </form> 
    </div>
    <div class="col-6">
      <form action="{{ url('/search') }}" method="GET" type="get">
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
            <td><img id="original" src="{{ url('image/'.$student->image) }}" height="70" width="70"></td>
            <td>{{$student->phone_no}}</td>
            <td>{{$student->address}}</td>
            <td><a href="" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="" method="post">
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