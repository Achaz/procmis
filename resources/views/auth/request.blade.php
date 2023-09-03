@php
$isMenu = false;
$navbarHideToggle = false;
@endphp

@extends('layouts/blankLayout')

@section('title', 'Registration')

@section('content')
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
<form class="mb-3" method="POST" action="{{ route('storeInvitation') }}">
        
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
                <button type="submit" class="btn btn-primary">
                    Request An Invitation
                </button>
            </div>
            <div class="mb-3">
                <a class="btn btn-link" href="{{ route('login.show') }}">
                    Already Have An Account?
                </a>
            </div>
        
    </form>
</div>
@endsection