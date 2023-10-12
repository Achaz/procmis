@extends('layouts/blankLayout')

@section('title', 'Approval Pending')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Waiting for Approval</div>

                    <div class="card-body">
                        Your account is waiting  our administrator's approval.
                        <br />
                        <br />
                        Please close the page and wait for email notification.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection