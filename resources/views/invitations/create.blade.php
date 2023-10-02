
@extends('layouts/contentNavbarLayout')

@section('title', 'Invite User')

@section('content')
  <div class="row">
    <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-md-6">
            <div class="card-body">
              <div class="layout-demo-wrapper">
                @if (session('error'))
                  <div class="alert alert-danger">
                    <p>{{ session('error') }}</p>
                  </div>
                @endif

                @if (session('success'))
                  <div class="alert alert-success">
                    <p>{{ session('success') }}</p>
                  </div>
                @endif
                <form class="mb-3" method="POST" action="{{ route('central.invitations.store') }}">
                  @csrf
                  <div class="mb-3 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="mb-3 control-label">E-Mail Address</label>
                    <div class="mb-3">
                      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                      @if ($errors->has('email'))
                        <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                      @endif
                    </div>
                  </div>
                  <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Send an invitation</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
