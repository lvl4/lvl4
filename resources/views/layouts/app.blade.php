<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>
      @yield('title')
      - lvl4.org
  </title>
  <link rel="stylesheet" type="text/css" href="/node_modules/semantic/dist/semantic.min.css">
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  @yield('styles')
</head>
<body>
  <div class="ui stackable menu">
    <div class="ui container">
      <div class="item">
        {{-- <img src="http://i.imgur.com/0eCkPtJ.png"> --}}
        @if (Auth::user())
          <a style="color:black" href="{{ route('wiki.index') }}"><h3><b>lvl4 <span style="color:red">.org</span></b></h3></a>
        @else
          <a style="color:black" href="{{ route('home.index') }}"><h3><b>lvl4 <span style="color:red">.org</span></b></h3></a>
        @endif
      </div>
      {{-- <form style="margin:0 !important;padding:0 !important;" action="{{ route('search.index') }}" method="POST"> --}}
        {{ csrf_field() }}
        <div style="width: 350px;" class="ui category search item">
          <div class="ui transparent icon input">
            <form id="searchform" action="{{ route('search.index') }}" method="POST" style="margin:0;padding:0;">
            {{ csrf_field() }}
            <input style="width: 295px;" class="prompt" name="search_term" type="text" placeholder="Search wikis, decks...">
              <i id="searchbutton" class="search link icon"></i>
            </form>
          </div>
        </div>
      {{-- </form> --}}
      {{-- <a class="item">Wikis</a> --}}
      {{-- <a class="item">Decks</a> --}}
      <div class="right menu">
          @if (Auth::guest())
              <div class="item">
                <a href="{{ route('auth.login') }}" class="ui button">Log In</a>
              </div>
              <div class="item">
                <a href="{{ route('auth.register') }}" class="ui primary button">Sign up</a>
              </div>
          @else
              <div class="ui dropdown item">
                <img class="ui avatar image" src="{{ Auth::user()->image }}" alt="">
                {{ Auth::user()->username }}
                <i class="dropdown icon"></i>
                <div class="menu">
                <a class="item" href="{{ route('account.show', Auth::user()->id) }}">My Account</a>

                  {{-- logout --}}
                  <a class="item" href="{{ url('/logout') }}"
                      onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                      Logout
                  </a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>

                </div>
              </div>
          @endif
      </div>
    </div>
  </div>

  <div class="ui grid centered container">
    @yield('content')
</div>
<script src="/node_modules/jquery/dist/jquery.js"></script>
<script src="/node_modules/semantic/dist/semantic.min.js"></script>
<script src="/js/app.js"></script>
@yield('scripts')
<script>
  $('#searchbutton').click(function(){
    $('#searchform').submit();
  });
</script>
</body>
</html>