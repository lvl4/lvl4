@extends('layouts.app')

@section('title')
  Sign Up
@endsection

@section('content')
<div class="ten wide column">
  <div class="ui fluid card">
    <div class="content">
      <div class="header">Sign Up</div>
    </div>
    <div class="content">
      <form class="ui form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}
        @if ($errors->has('username'))
            <div class="field error">
              <label>Username</label>
              <input type="text" name="username" placeholder="{{ $errors->first('username') }}">
            </div>
        @else
            <div class="field">
              <label>Username</label>
              <input type="text" name="username" placeholder="Username" value="{{ old('username') }}">
            </div>
        @endif

        @if ($errors->has('email'))
            <div class="field error">
              <label>Email</label>
              <input type="email" name="email" placeholder="{{ $errors->first('email') }}">
            </div>
        @else
            <div class="field">
              <label>Email</label>
              <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>
        @endif

        @if ($errors->has('first_name'))
            <div class="field error">
              <label>First Name</label>
              <input type="text" name="first_name" placeholder="{{ $errors->first('first_name') }}">
            </div>
        @else
            <div class="field">
              <label>First Name</label>
              <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}"> 
            </div>
        @endif

        @if ($errors->has('last_name'))
            <div class="field error">
              <label>Last Name</label>
              <input type="text" name="last_name" placeholder="{{ $errors->first('last_name') }}">
            </div>
        @else
            <div class="field">
              <label>Last Name</label>
              <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
            </div>
        @endif

        @if ($errors->has('password'))
            <div class="field error">
              <label>Password</label>
              <input type="password" name="password" placeholder="{{ $errors->first('password') }}">
            </div>
        @else
            <div class="field">
              <label>Password</label>
              <input type="password" name="password" placeholder="Password">
            </div>
        @endif
    </div>
    <div class="extra content">
        <button class="ui green button" type="submit">Sign Up</button>
    </div>
  </form>
  </div>
</div>
@endsection