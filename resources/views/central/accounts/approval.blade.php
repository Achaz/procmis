@extends('layouts/blankLayout')

@section('title', 'Approval Pending')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <div class="app-brand justify-content-center">
                        <a href="{{url('/')}}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo"><img src={{global_asset("assets/img/logo.svg")}}></span>
                            <span class="app-brand-text demo text-body fw-bolder">{{config('variables.templateName')}}</span>
                        </a>
                    </div>                 
                    Excellent! your account is awaiting  the administrator's approval.
                    <br />
                    <br/>
                    Please close this page and check your email for login instructions.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection