@extends('layouts/usercontentNavbarLayout')

@section('title', 'Bids Edit')

@section('content')
<div class="row">
    <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="mt-2">
                    <h4>Edit Bid</h4>                 
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
                <form class="my-4 relative" method="POST" enctype="multipart/form-data" action="{{ route('tenants.bids.update', [tenant('id'), $bid]) }}">
                @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group mb-2">
                                <label class="form-label" for="procurementplan">Procurement Plan</label>
                                <select class="form-select @error('procurementplan') is-invalid @enderror" name="procurementplan">
                                    <option selected value="">Select Plan</option>
                                    <option value="goods" {{ $bid ->procurementplan === 'goods' ? 'selected' : ''}} >FY2021</option>
                                    <option value="services" {{ $bid ->procurementplan === 'services' ? 'selected' : ''}} >FY2020</option>
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
                                    <option value="goods" {{ $bid ->procurementsubject === 'goods' ? 'selected' : ''}}>Goods</option>
                                    <option value="services" {{ $bid ->procurementsubject === 'services' ? 'selected' : ''}}>Services</option>
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
                                <input id="ReferenceNumber" type="text" class="form-control @error('ReferenceNumber') is-invalid @enderror" name="ReferenceNumber" value="{{ $bid->referenceNumber }}"  autocomplete="ReferenceNumber" autofocus placeholder="Enter Reference Number">
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
                                    <option value="goods" {{ $bid ->procurementtype === 'goods' ? 'selected' : ''}} >Goods</option>
                                    <option value="services" {{ $bid ->procurementtype === 'services' ? 'selected' : ''}}>Services</option>
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
                                <textarea id="summary" type="text" class="form-control @error('summary') is-invalid @enderror" name="summary" value="{{ $bid->summary }}"  autocomplete="briefDescription" autofocus placeholder="A brief description of the tender notice (Max 500 Characters)"></textarea>
                                @error('summary')
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
                                <label class="form-label" for="submissiondeadline">Submission Deadline</label> 
                                <input class="form-control" name="submissiondeadline" type="text" id="submissiondeadline" value="{{ old('submissiondeadline', $bid->submissiondeadline) }}"/>
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
                                    <option value="saved" {{ $bid->status === 'saved' ? 'selected' : ''}} >Saved</option>
                                    <option value="cancelled" {{ $bid->status === 'cancelled' ? 'selected' : ''}}>Cancelled</option>
                                    <option value="extended" {{ $bid->status === 'extended' ? 'selected' : ''}}>Extended</option>
                                    <option value="published" {{ $bid->status === 'published' ? 'selected' : ''}}>Published/issued</option>
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
                            <button type="submit" class="btn btn-success float-end">Update</button>
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