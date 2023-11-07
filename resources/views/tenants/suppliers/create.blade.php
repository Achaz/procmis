@extends('layouts/blankLayout')

@section('title', 'Create Supplier')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection
@section('content')
<div class="mt-5">
</div>
<div class="row"> 
    <div class="col-8 mx-auto">
        <div class="card">
            <div class="card-body ">
                <div class="app-brand justify-content-center">
                    <a href="{{url('/')}}" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo"><img src={{global_asset("assets/img/logo.svg")}}></span>
                    <span class="app-brand-text demo text-body fw-bolder">{{config('variables.templateName')}}</span>
                    </a>
                </div>
                <div class="mt-3">
                    <h5>Register Supplier</h5>                 
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
                <form class="mb-3" enctype="multipart/form-data" method="POST" action="{{ route('tenants.suppliers.store', tenant('id')) }}">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('suppliername') is-invalid @enderror" for="suppliername">Name:</label> 
                                <input class="form-control" type="text" name="suppliername" id="suppliername" value="" autofocus placeholder="Supplier Name"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('email') is-invalid @enderror" for="email">Email:</label> 
                                <input class="form-control" type="text" name="email" id="email" value="" autofocus placeholder="Email"/>
                            </div>
                        </div>
                    </div> 
                    <div class="row"> 
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('supplierphone') is-invalid @enderror" for="supplierphone">Telephone:</label> 
                                <input class="form-control" type="text" name="supplierphone" id="supplierphone" value="" autofocus placeholder="Telephone"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('supplieraddress') is-invalid @enderror" for="supplieraddress">Address:</label> 
                                <input class="form-control" type="text" name="supplieraddress" id="supplieraddress" value="" autofocus placeholder="Address"/>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('suppliercity') is-invalid @enderror" for="suppliercity">City:</label> 
                                <input class="form-control" type="text" name="suppliercity" id="suppliercity" value="" autofocus placeholder="City"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label" for="supplierstate">Region/State:</label> 
                                <input class="form-control @error('supplierstate') is-invalid @enderror" type="text" name="supplierstate" id="supplierstate" value="" autofocus placeholder="Region/State"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('supplierzip') is-invalid @enderror" for="supplierzip">Zip code:</label> 
                                <input class="form-control" type="text" name="supplierzip" id="supplierzip" value="" autofocus placeholder="Zip code"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('suppliercountry') is-invalid @enderror" for="suppliercountry">Country:</label> 
                                <input class="form-control" type="text" name="suppliercountry" id="suppliercountry" value="" autofocus placeholder="Country"/>
                            </div>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <label class="form-label" for="password">Confirm Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="confirm-password" name="confirm-password" placeholder="password">
                        </div>
                    </div>
                    <div class="mt-5">                   
                        <div class="col-xs-12 col-sm-12 col-md-12 ">
                            <button type="submit" class="btn btn-info float-end">Register</button>
                        </div>     
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
@endsection