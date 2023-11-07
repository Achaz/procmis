@extends('layouts.usercontentNavbarLayout')

@section('title', 'Users')

@section('content')
<div class="mt-5">
</div>
<div class="row"> 
    <div class="col-8 mx-auto">
       <div class="card">
           <div class="card-body">
              <div class="mt-2">
                  <h4>Create User</h4>                 
              </div>
              <hr>
            @if (session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <p>{{ session('error') }}</p>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              @if(Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session::get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif           
            <form action="{{ route('tenants.users.store', tenant('id')) }}" method="post">
            @csrf
            <div class="mt-3">
               <div class="col-xs-12 col-sm-6 col-md-6">
                  <label class="form-label" for="name" >Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                  @if ($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
               </div>
            </div>
            <div class="mt-3">
                <div class="col-xs-12 col-sm-6 col-md-6">
                  <label class="form-label" for="username" >Username</label>
                  <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}">
                  @if ($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('username') }}</span>
                  @endif
                </div>
            </div>
            <div class="mt-3">
                <div class="col-xs-12 col-sm-6 col-md-6">
                  <label class="form-label" for="email" >Email Address</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                  @if ($errors->has('email'))
                      <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
                </div>
            </div>
            <div class="mt-3">
                <div class="col-xs-12 col-sm-6 col-md-6">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                  @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
                </div>
            </div>            
            <div class="mt-3">
                <input type="submit" class="btn btn-primary" value="Register">
            </div>         
          </form>      
        </div>
      </div>
    </div>
</div>
@endsection
