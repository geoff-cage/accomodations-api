@extends('layouts.app')

@section('content')
<!-- Pills navs -->
<ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="/loginin" role="tab"
        aria-controls="pills-login" aria-selected="true">Login</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="/registering" role="tab"
        aria-controls="pills-register" aria-selected="false">Register</a>
    </li>
  </ul>
  <!-- Pills navs -->
  
  <!-- Pills content -->
  <div class="tab-content">
    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
      <form action="/login" method="POST">
        @csrf
        <!-- Email input -->
        <div class="form-outline mb-4">
          <input type="email" id="loginName" class="form-control" />
          <label class="form-label" for="loginName">Email</label>
        </div>
  
        <!-- Password input -->
        <div class="form-outline mb-4">
          <input type="password" id="loginPassword" class="form-control" />
          <label class="form-label" for="loginPassword">Password</label>
        </div>
  
        <!-- 2 column grid layout -->
        <div class="row mb-4">
          <div class="col-md-6 d-flex justify-content-center">
            <!-- Checkbox -->
          </div>
  
        </div>
  
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>
  
        <!-- Register buttons -->
        <div class="text-center">
          <p>Not a member? <a href="/registering">Register</a></p>
        </div>
      </form>
    </div>
  </div>
  <!-- Pills content -->
@endsection