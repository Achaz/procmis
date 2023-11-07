
@extends('layouts/usercontentNavbarLayout')

@section('title', 'Invite Supplier')

@section('content')
<div class="mt-3">
</div>
 <div class="row"> 
    <div class="col-8 mx-auto">
      <div class="card">
        <div class="card-body">              
          <div class="mt-2">
            <h4>Invite supplier</h4>                 
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
          <form class="mb-3" method="POST" action="{{ route('tenants.invitations.store', tenant('id')) }}">
            @csrf      
            <div class="mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">                        
                <div class="d-flex justify-content-center">      
                    <div class="col-xs-12 col-sm-6 col-md-6">   
                        <label for="email" class="mb-3 control-label">Email Address</label>  
                        <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                        @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
              <div class="mb-3">
                <button type="submit" class="btn btn-primary">Send invitation</button>
              </div>
            </div>
          </form>                
        </div>
      </div>
    </div>
  </div>
@endsection