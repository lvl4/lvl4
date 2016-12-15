@extends('layouts.master')
@section('title')
Log In
@endsection
@section('content')
<div class="container-fluid body">
    <div class="col-md-6 col-md-offset-3">
        <div class="content">
            <h1>
            <b>Log In</b>
            </h1>
            <div class="card">
            @if ($errors->has('username'))
                <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('username') }}</div>
            @endif
            @if ($errors->has('password'))
                <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('password') }}</div>
            @endif
            @if (Session::has('message'))
                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
            @endif
            @if (Session::has('loginError'))
                <div class="alert alert-danger" role="alert">{{ Session::get('loginError') }}</div>
            @endif
                <form action="{{ route('login.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <label for=""><span class="red">*</span> Username</label>
                        <input type="text" name="username" class="form-control" required>
                        <p></p>
                    </div>
                    <div class="col-md-12">
                        <label for=""><span class="red">*</span> Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <p></p>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-info pull-right">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection