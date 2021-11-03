@extends('layout')
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
  <a href="{{ route('student.create')}}" class="btn btn-primary">Create Student</a>
  <table class="table">
    <thead class="thead-light">
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Phone Number</th>
          <th>Address</th>
          <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{$student->id}}</td>
            <td>{{$student->full_name}}</td>
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
    </tbody>
  </table>
<div>
@endsection