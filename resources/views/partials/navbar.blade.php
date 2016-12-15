<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">lvl4.org</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::user())
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->username }}
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('setting.index') }}">Settings</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/logout">Logout</a></li>
            </ul>
          </li>
        @else
          <li><a href="{{ route('login.index') }}">Log In</a></li>
          <li><a class="button btn-blue" href="{{ route('signup.index') }}">Sign Up</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>