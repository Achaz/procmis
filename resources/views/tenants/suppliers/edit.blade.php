@extends('layouts/usercontentNavbarLayout')

@section('title', 'Edit Supplier')

@section('content')
<div class="mt-3">
</div>
<div class="row"> 
    <div class="col-8 mx-auto">
        <div class="card">
            <div class="card-body ">
                <div class="mt-2">
                    <h4>Edit Supplier</h4>                 
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
                <form class="mb-3" enctype="multipart/form-data" method="POST" action="{{ route('tenants.suppliers.update', [tenant('id'), $supplier]) }}">
                @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('suppliername') is-invalid @enderror" for="suppliername">Name:</label> 
                                <input class="form-control" type="text" name="suppliername" id="suppliername" value="{{ $supplier->name }}" autofocus placeholder="Supplier Name"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('email') is-invalid @enderror" for="email">Email:</label> 
                                <input class="form-control" type="text" name="email" id="email" value="{{ $supplier->email }}" autofocus placeholder="Email"/>
                            </div>
                        </div>
                    </div> 
                    <div class="row"> 
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('supplierphone') is-invalid @enderror" for="supplierphone">Telephone:</label> 
                                <input class="form-control" type="text" name="supplierphone" id="supplierphone" value="{{ $supplier->phone }}" autofocus placeholder="Telephone"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('supplieraddress') is-invalid @enderror" for="supplieraddress">Address:</label> 
                                <input class="form-control" type="text" name="supplieraddress" id="supplieraddress" value="{{ $supplier->address }}" autofocus placeholder="Address"/>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('suppliercity') is-invalid @enderror" for="suppliercity">City:</label> 
                                <input class="form-control" type="text" name="suppliercity" id="suppliercity" value="{{ $supplier->city }}" autofocus placeholder="City"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label" for="supplierstate">Region/State:</label> 
                                <input class="form-control @error('supplierstate') is-invalid @enderror" type="text" name="supplierstate" id="supplierstate" value="{{ $supplier->state }}" autofocus placeholder="Region/State"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('supplierzip') is-invalid @enderror" for="supplierzip">Zip code:</label> 
                                <input class="form-control" type="text" name="supplierzip" id="supplierzip" value="{{ $supplier->zipcode }}" autofocus placeholder="Zip code"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label @error('suppliercountry') is-invalid @enderror" for="suppliercountry">Country:</label> 
                                <input class="form-control" type="text" name="suppliercountry" id="suppliercountry" value="{{ $supplier->country }}" autofocus placeholder="Country"/>
                            </div>
                        </div>
                    </div> 
                    <div  class="mt-3">
                        <br> <div class="col-xs-12 col-sm-12 col-md-12 ">
                            <button type="submit" class="btn btn-success float-end">Update</button>
                            <a href="{{ route('tenants.suppliers.index', tenant('id')) }}" class="btn btn-dark float-right">Cancel</a>
                        </div>
                    </div>  
                </form> 
            </div>        
        </div>
    </div>
</div>
@endsection