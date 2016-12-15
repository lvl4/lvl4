@extends('layouts.master')
@section('title')
Sign Up
@endsection
@section('content')
<div class="container-fluid body">
    <div class="col-md-6 col-md-offset-3">
        <div class="content">
            <h1>
                <b>Sign Up</b>
            </h1>
            <div class="card">
                @if ($errors->has('first_name'))
                    <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('first_name') }}</div>
                @endif
                @if ($errors->has('last_name'))
                    <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('last_name') }}</div>
                @endif
                @if ($errors->has('email'))
                    <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('email') }}</div>
                @endif
                @if ($errors->has('username'))
                    <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('username') }}</div>
                @endif
                @if ($errors->has('password'))
                    <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('password') }}</div>
                @endif

                <form action="{{ route('signup.store') }}" method="POST"> 
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <label for=""><span class="red">*</span> Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                        <p></p>
                    </div>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                        <p></p>
                    </div>
                    <div class="col-md-12">
                        <label for=""><span class="red">*</span> Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        <p></p>
                    </div>
                    <div class="col-md-12">
                        <label for=""><span class="red">*</span> Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <p></p>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-info pull-right">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection