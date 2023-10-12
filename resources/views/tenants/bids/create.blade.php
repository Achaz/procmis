@extends('layouts/usercontentNavbarLayout')

@section('title', 'Create Bid')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
            <div class="card-body ">
                <div class="mt-2">
                    <h4>Create Bid</h4>                 
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
                @php
               
                $procurementplans = App\Models\ProcurementPlan::get(['id','title']);
                
                @endphp
                <form class="my-4 relative" enctype="multipart/form-data" method="POST" action="{{ route('tenants.bids.store', tenant('id')) }}">
                    @csrf                   
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label" for="procurementplan">Procurement Plan</label>
                                <select class="form-select @error('procurementplan') is-invalid @enderror" name="procurementplan">
                                    <option selected value="">Select Plan</option>
                                    @foreach($procurementplans as $procurementplan)
                                    <option value="{{ $procurementplan->title }}">{{ $procurementplan->title }}</option>
                                    @endforeach
                                </select>
                                @error('procurementplan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label" for="subject">Subject of Procurement</label>
                                <select class="form-select @error('subject') is-invalid @enderror" name="subject">
                                    <option selected value="">Select</option>
                                    <option value="goods" >Goods</option>
                                    <option value="services">Services</option>
                                </select>
                                @error('subject')
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
                                <label class="form-label" for="ReferenceNumber">Reference Number</label>
                                <input id="ReferenceNumber" type="text" class="form-control @error('ReferenceNumber') is-invalid @enderror" name="ReferenceNumber" value="{{ old('ReferenceNumber') }}"  autocomplete="phonenumber" autofocus placeholder="Enter Reference Number">
                                    @error('ReferenceNumber')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label" for="ProcurementType">Type of Procurement</label>
                                <select class="form-select @error('ProcurementType') is-invalid @enderror" name="ProcurementType">
                                    <option selected value="">Select Type of Procurement</option>
                                    <option value="goods" >Goods</option>
                                    <option value="services">Services</option>
                                </select>
                                @error('ProcurementType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-12">
                            <div class="form-group mb-2">
                                <label class="form-label" for="summary">Summary</label>
                                <textarea id="summary" type="text" class="form-control @error('summary') is-invalid @enderror" name="summary" value="{{ old('summary') }}"  autocomplete="briefDescription" autofocus placeholder="A brief description of the tender notice (Max 500 Characters)"></textarea>
                                @error('summary')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row relative">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label" for="submissiondeadline">Submission Deadline</label> 
                                <input class="form-control" name="submissiondeadline" type="text" id="submissiondeadline"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                            <label class="form-label" for="documents">Add Documents</label> 
                                <input type="file" name="file" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label" for="displayperiod">Display Period</label> 
                                <input class="form-control" type="text" name="displayperiod" id="displayperiod" value="01/01/2018 - 01/15/2018" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                            <label class="form-label" for="status">Status</label> 
                                <select class="form-select @error('status') is-invalid @enderror" name="status">
                                    <option selected value="">Select</option>
                                    <option value="saved" >Saved</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="extended">Extended</option>
                                    <option value="published">Published/issued</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
@push('css')
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src= "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"> </script>
<script>
(function() {
    $('#submissiondeadline').datetimepicker({
        format: 'YYYY/MM/DD'
    });
    
}());
$(function() {
  $('input[name="displayperiod"]').daterangepicker({
    timePicker: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'M/DD hh:mm A'
    }
  });
});
</script>
<script>

</script>
@endpush