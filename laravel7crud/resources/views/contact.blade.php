@extends('layouts.app')
@section('title', 'Contact Us')
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
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
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
      <form method="post" action="{{ route('contact.contactSubmit') }}">
          <div class="form-group">
              @csrf
              <label for="full_name">Full Name:</label>
              <input type="text" class="form-control" name="full_name" required />
          </div>
          <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" class="form-control" name="email" required/>
          </div>
          <div class="form-group">
              <label for="phone_no">Phone Nubmer:</label>
              <input type="text" class="form-control" name="phone_no" required/>
          </div>
          <div class="form-group">
              <label for="message">Message :</label>
              <textarea rows="5" columns="5" class="form-control" name="message"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>
</div>
@endsection