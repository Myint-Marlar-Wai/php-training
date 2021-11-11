@extends('layout')
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    <h1>Contact Form Message</h1>
  </div>
  <div class="card-body">
    <p>Name : {{ $full_name }}</p>
    <p>Email : {{ $email }}</p>
    <p>Phone Number : {{ $phone_no }}</p>
    <p>Message : {{ $msg }}</p>
  </div>
</div>
@endsection