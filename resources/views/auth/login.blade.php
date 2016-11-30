@extends('layouts.app')

@section('title')
    Login
@endsection

@section('content')
  <div class="ten wide column">
    <div class="ui fluid card">
      <div class="content">
        <div class="header">Log In</div>
      </div>
      <div class="content">
        @if (Session::has('error'))
          <div class="ui error message">
            <div class="header">
              {{ Session::get('error') }}
            </div>
          </div>
        @endif 
        <form class="ui form" method="POST" action="{{ url('/login') }}">
          {{ csrf_field() }}
            @if ($errors->has('username'))
              <div class="field error">
                <label>Username</label>
                <input type="text" name="username" placeholder="{{ $errors->first('username') }}" value="">
              </div>
            @else
              <div class="field">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username" value="">
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
          <button class="ui green button" type="submit">Log In</button>
      </div>
      </form>
    </div>
  </div>
@endsection