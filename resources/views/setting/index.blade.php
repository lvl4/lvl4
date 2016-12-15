@extends('layouts.master')

@section('title')
    Settings
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-superpowers green"></i> Your Settings</h1>
            <i>Modify & update your settings</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
              <li class="active">Settings</li>
            </ol>
            <div class="content">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                
                @if ($errors->has('first_name'))
                    <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('first_name') }}</div>
                @endif
                @if ($errors->has('last_name'))
                    <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('last_name') }}</div>
                @endif
                @if ($errors->has('username'))
                    <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('username') }}</div>
                @endif
                @if ($errors->has('email'))
                    <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('email') }}</div>
                @endif
                @if ($errors->has('password'))
                    <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('password') }}</div>
                @endif

                <form action="{{ route('setting.update') }}" method="POST">
                {{ csrf_field() }}
                <button class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Save Changes</button>
                <br>
                <p> </p>
                <div class="card">
                    <h2><b>Settings</b></h2>
                    <br>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required>
                        <br>
                        <br>
                        <label for=""><span class="red">*</span> Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required>
                        <br>
                        <br>
                        <label for=""><span class="red">*</span> Username</label>
                        <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                        <br>
                        <br>
                        <label for=""><span class="red">*</span> Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $user->email }}" required>
                        <br>
                        <br>
                    </div>
                    <div class="col-md-6">
                        <label for="">Change Password</label>
                        <input type="password" name="new_password" class="form-control">
                        <br>
                        <br>
                    </div>
                </div>
                </form>
                <center>
                </center> 
            </div>
        </div> 
    </div>
@endsection