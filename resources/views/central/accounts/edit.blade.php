@extends('layouts.contentNavbarLayout')

@section('title', 'Users Update')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="row row-bordered g-0">
                    <div class="col-md-6">
                        <div class="card-body">
                            <div class="mt-2">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <form method="post" action="{{ route('central.accounts.update', $account) }}">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input value="{{ $account->name }}" type="text" class="form-control" name="name"
                                           placeholder="Name" required>

                                    @if ($errors->has('name'))
                                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input value="{{ $account->email }}" type="email" class="form-control" name="email"
                                           placeholder="Email address" required>
                                    @if ($errors->has('email'))
                                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input value="{{ $account->username }}" type="text" class="form-control"
                                           name="username"
                                           placeholder="Username" required>
                                    @if ($errors->has('username'))
                                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Update user</button>
                                <a href="{{ route('central.accounts.index') }}" class="btn btn-dark">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
