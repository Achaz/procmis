@extends('layouts/usercontentNavbarLayout')

@section('title', 'Procurement Plan Edit')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
            <div class="card-body ">
                <div class="mt-2">
                    <h4>Edit procurement plan</h4>                 
                </div>
                <hr>
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
              <form class="my-4 relative" method="POST" enctype="multipart/form-data" action="{{ route('tenants.procurement.update', [tenant('id'), $procurementplan]) }}">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                      <div class="form-group mb-2">
                          <label class="form-label" for="financialperiod">Financial Period</label>
                          <select class="form-select @error('financialperiod') is-invalid @enderror" name="financialperiod">
                              <option selected value="">Select Period</option>
                              <option value="FY 2024-2025" {{ $procurementplan ->financialperiod === 'FY 2024-2025' ? 'selected' : ''}}>FY 2024-2025</option>
                              <option value="FY 2023-2024" {{ $procurementplan ->financialperiod === 'FY 2023-2024' ? 'selected' : ''}}>FY 2023-2024</option>
                              <option value="FY 2022-2023" {{ $procurementplan ->financialperiod === 'FY 2022-2023' ? 'selected' : ''}}>FY 2022-2023</option>
                              <option value="FY 2021-2022" {{ $procurementplan ->financialperiod === 'FY 2021-2022' ? 'selected' : ''}}>FY 2021-2022</option>
                              <option value="FY 2020-2021" {{ $procurementplan ->financialperiod === 'FY 2020-2021' ? 'selected' : ''}}>FY 2020-2021</option>
                              <option value="FY 2019-2020" {{ $procurementplan ->financialperiod === 'FY 2019-2020' ? 'selected' : ''}}>FY 2019-2020</option>
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
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $procurementplan->title }}"  autocomplete="title" autofocus placeholder="Plan Title">
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
                              <option value="saved" {{ $procurementplan ->status === 'saved' ? 'selected' : ''}} >Saved</option>
                              <option value="published" {{ $procurementplan ->status === 'published' ? 'selected' : ''}}>Published</option>
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
                        <button type="submit" class="btn btn-success float-end">Update</button>
                    </div>
                </div>
              </form>                      
            </div>
        </div>
    </div>
</div>
@endsection
