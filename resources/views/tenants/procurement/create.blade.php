@extends('layouts/usercontentNavbarLayout')

@section('title', 'Procurement Plan')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
            <div class="card-body ">
                <div class="mt-2">
                    <h4>Create procurement plan</h4>                 
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
              <form class="my-4 relative" method="POST" enctype="multipart/form-data" action="{{ route('tenants.procurement.store', tenant('id')) }}">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                      <div class="form-group mb-2">
                          <label class="form-label" for="financialperiod">Financial Period</label>
                          <select class="form-select @error('financialperiod') is-invalid @enderror" name="financialperiod">
                              <option selected value="">Select Period</option>
                              <option value="FY 2024-2025">FY 2024-2025</option>
                              <option value="FY 2023-2024">FY 2023-2024</option>
                              <option value="FY 2022-2023">FY 2022-2023</option>
                              <option value="FY 2021-2022">FY 2021-2022</option>
                              <option value="FY 2020-2021">FY 2020-2021</option>
                              <option value="FY 2019-2020">FY 2019-2020</option>
                          </select>
                          @error('financialperiod')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                    </div>                
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label" for="title">Title</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value=""  autocomplete="title" autofocus placeholder="Plan Title">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>                        
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group mb-2">
                          <label class="form-label" for="status">Status</label> 
                          <select class="form-select @error('status') is-invalid @enderror" name="status">
                              <option selected value="">Select</option>
                              <option value="saved" >Saved</option>
                              <option value="published">Published</option>
                          </select>
                          @error('status')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group mb-2">
                            <label class="form-label" for="details">Details</label> 
                            <input type="file" name="file" class="form-control"/>
                        </div> 
                    </div> 
                </div>
                <div class="row">
                    <br> <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-success float-end">Create</button>
                    </div>
                </div>
              </form>                      
            </div>
        </div>
    </div>
</div>
@endsection