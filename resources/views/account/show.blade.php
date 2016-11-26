@extends('layouts.app')

@section('title')
    Account
@endsection

@section('content')
  <div class="four wide column">
    <div class="ui card">
      <div class="image">
        <img src="{{ $user->image }}">
      </div>
      <div class="content">
        <div class="header">{{ $user->username }}</div>
        <h3 style="margin-top:0px; color: #888; font-weight: 200">{{ $user->first_name }} {{ $user->last_name }}</h3>
        <div class="meta">
          <span class="date">Joined in {{ date('Y', strtotime($user->created_at)) }}</span>
        </div>
      </div>
    </div>
  </div>
  <div class="twelve wide column">
    <h2 class="ui header">
       Account Overview
      <div class="sub header">View your bank and manage your account settings.</div>
    </h2>
    <div class="ui pointing secondary menu">
      <a class="tab-item item " data-tab="first">Bank</a>
      @if (Auth::user()->id === $user->id)
          <a class="tab-item item" data-tab="second">Settings</a>
        @if (Auth::user()->role_id === 2)
          <a class="tab-item item" data-tab="third">Wikis</a>
          <a class="tab-item item" data-tab="fourth">Decks</a>
          <a class="tab-item item" data-tab="fifth">Cards</a>
          <a class="tab-item item" data-tab="sixth">Tags</a>
        @endif
      @endif
    </div>
    <div id="first" class="ui tab segment" data-tab="first">
    @if (Session::has('message'))
      <div class="ui success message">
        <div class="header">
          {{ Session::get('message') }}
        </div>
      </div>
    @endif 
      <div class="ui relaxed divided list">
        @if (count($banks) > 0)
          @foreach ($banks as $bank)
            <div class="item">
              <i class="large file text outline middle aligned icon"></i>
              <div style="width: 100%;" class="content">
                <form action="{{ route('bank.destroy', $bank->id) }}" method="POST" style="float:right">
                  {{ csrf_field() }}
                  <button class="ui button mini red">Remove</button>
                </form>
                <a href="{{ route('deck.show', $bank->id) }}" class="header">{{ $bank->name }} </a>

                <div class="description">{{ date('j M Y', strtotime($bank->bank_created_at)) }}</div>
              </div>
            </div>
          @endforeach
        @else
          <div class="ui icon info message">
            <i class="info icon"></i>
            <div class="content">
              <div class="header">
                You have 0 decks in your bank
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
    @if (Auth::user()->id === $user->id)
      <div id="second" class="ui tab " data-tab="second">
      
        @if ($errors->has('first_name'))
          <div class="ui error message">
            <div class="header">
              {{ $errors->first('first_name') }}
            </div>
          </div>
        @endif
        @if ($errors->has('last_name'))
          <div class="ui error message">
            <div class="header">
              {{ $errors->first('last_name') }}
            </div>
          </div>
        @endif
        @if ($errors->has('email'))
          <div class="ui error message">
            <div class="header">
              {{ $errors->first('email') }}
            </div>
          </div>
        @endif
        @if ($errors->has('username'))
          <div class="ui error message">
            <div class="header">
              {{ $errors->first('username') }}
            </div>
          </div>
        @endif
        @if (Session::has('message'))
          <div class="ui success message">
            <div class="header">
              {{ Session::get('message') }}
            </div>
          </div>
        @endif 
        <div class="ui fluid card">
          <div class="content">
            <div class="header">Account Settings</div>
          </div>
          <div class="content">
            <form class="ui form" action="{{ route('user.update') }}" method="POST"> 
              {{ csrf_field() }}
              <div class="two fields">
                <div class="field">
                  <label>First Name</label>
                  <input type="text" name="first_name" value="{{ $user->first_name }}" required>
                </div>
                <div class="field">
                  <label>Last Name</label>
                  <input type="text" name="last_name" value="{{ $user->last_name }}" required>
                </div>
              </div>

              <div class="two fields">
                <div class="field">
                  <label>Email</label>
                  <input type="email" name="email" value="{{ $user->email }}" required>
                </div>
                <div class="field">
                  <label>Username</label>
                  <input type="text" name="username" value="{{ $user->username }}" required>
                </div>
              </div>
          </div>
          <div class="extra content">
            <button type="submit" class="ui green button">Save Changes</button>
          </div>
            </form>
        </div>
      </div>
    @endif

    @if (Auth::user()->role_id === 2)      
      <div id="third" class="ui tab" data-tab="third">  
        @if (Session::has('message'))
          <div class="ui success message">
            <div class="header">
              {{ Session::get('message') }}
            </div>
          </div>
        @endif    
        <a href="{{ route('wiki.create') }}" class="ui button green">New Wiki</a>
        <div class="ui segment">
          <div class="ui relaxed divided list">
            @foreach ($my_wikis as $my_wiki)  
              <div class="item">
                <i class="large file text outline middle aligned icon"></i>
                <div style="width: 100%;" class="content">
                  @if ($my_wiki->status == 'unpublished')
                    <span class="right floated negative-text">Unpublished</span>
                  @else
                    <span class="right floated positive-text">Published</span>
                  @endif
                  <a  href="{{ route('wiki.edit', $my_wiki->id) }}" class="header">{{ $my_wiki->title }}</a>
                  <div class="description">{{ date('j M Y', strtotime($my_wiki->created_at)) }}</div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>

      <div id="fourth" class="ui tab" data-tab="fourth">      
        {{-- <a href="{{ route('wiki.create') }}" class="ui button green">New Deck</a> --}}
        @if ($errors->has('name'))
          <div class="ui error message">
            <div class="header">
              {{ $errors->first('name') }}
            </div>
          </div>
        @endif
        @if (Session::has('message'))
          <div class="ui success message">
            <div class="header">
              {{ Session::get('message') }}
            </div>
          </div>
        @endif
        <form action="{{ route('deck.store') }}" method="POST">
          {{ csrf_field() }}
          <div class="ui form">
            <div class="inline fields">
              <div class="seven wide field">
                <input name="name" type="text" placeholder="Name" required>
              </div>
              <div class="seven wide field">
                <select name="wiki_id" class="ui search dropdown" required>
                  <option value="">Select Wiki</option>
                  @foreach ($wikis as $wiki)
                    <option value="{{ $wiki->id }}">{{ $wiki->title }}</option>
                  @endforeach
                </select>
              </div>
              <div class="two wide field">
                <button type="submit" class="ui small fuid green button">Add Deck</button>
              </div>
            </div>
          </div>
        </form>
        <div class="ui divider"></div>
        <div class="ui segment">
          <div class="ui relaxed divided list">
              @foreach ($decks as $deck)
                <div class="item">
                  <i class="large file text outline middle aligned icon"></i>
                  <div style="width: 100%;" class="content">
                    @if ($deck->status == 'unpublished')
                      <span class="right floated negative-text">Unpublished</span>
                    @else
                      <span class="right floated positive-text">Published</span>
                    @endif
                    <a href="{{ route('deck.edit', $deck->id) }}" class="header">{{ $deck->name }}</a>
                    <div class="description">{{ date('j M Y', strtotime($deck->created_at)) }}</div>
                  </div>
                </div>
              @endforeach
          </div>
        </div>
      </div>

      <div id="fifth" class="ui tab" data-tab="fifth">      
        <a href="{{ route('card.create') }}" class="ui button green">New Card</a>
        <div class="ui divider"></div>
        <div class="ui segment">
          <div class="ui relaxed divided list">
              @foreach ($decks as $deck)
                <div class="item">
                  <i class="large file text outline middle aligned icon"></i>
                  <div style="width: 100%;" class="content">
                    <a href="{{ route('card.view', $deck->id) }}" class="header">{{ $deck->name }}</a>
                    <div class="description">{{ date('j M Y', strtotime($deck->created_at)) }}</div>
                  </div>
                </div>
              @endforeach
          </div>
        </div>
      </div>

      <div id="sixth" class="ui tab" data-tab="sixth">      
        @if ($errors->has('name'))
          <div class="ui error message">
            <div class="header">
              {{ $errors->first('name') }}
            </div>
          </div>
        @endif
        @if (Session::has('message'))
          <div class="ui success message">
            <div class="header">
              {{ Session::get('message') }}
            </div>
          </div>
        @endif
        <form action="{{ route('tag.store') }}" method="POST">
          {{ csrf_field() }}
          <div class="ui form">
            <div class="fields">
                <div class="fourteen wide field">
                  <input type="text" name="name" placeholder="Tag" required>
                </div>
                <div class="two wide field">
                  <button type="submit" class="ui button fluid green">Add tag</button>
                </div>
            </div>
          </div>
        </form>
        <div class="ui divider"></div>
        <div class="ui segment">
          <div class="ui relaxed divided list">
              @foreach ($tags as $tag)
                <div class="item">
                  <i class="large file text outline middle aligned icon"></i>
                  <div style="width: 100%;" class="content">
                    <a href="{{ route('tag.edit', $tag->id) }}" class="header">{{ $tag->name }}</a>
                    <div class="description">{{ date('j M Y', strtotime($tag->created_at)) }}</div>
                  </div>
                </div>
              @endforeach
          </div>
        </div>
      </div>

    @endif
  </div>
@endsection

@section('scripts')
  <script>
    $('.tab-item').click(function(){
      tab = $(this).data('tab');
      $('.message.success').remove();
      $('#first').removeClass('active');
      $('#'+tab).addClass('active');

      $.post( "/api/set/active", { active: tab } );
    });

    var active = '{{ Session::get('active') }}';
    $('#first').removeClass('active');
    $('#second').removeClass('active');
    $('#third').removeClass('active');
    $('#fourth').removeClass('active');
    $('#fifth').removeClass('active');
    $('#sixth').removeClass('active');

    if(active !== ''){
      $('#'+active).addClass('active');
      $.each($('.tab-item'),function(item){
        if($(this).data('tab') == active){
          $(this).addClass('active');
        }
      });
    }else{
      $('#first').addClass('active');
      $.each($('.tab-item'),function(item){
        if($(this).data('tab') == 'first'){
          $(this).addClass('active');
        }
      });
    }
  </script>
@endsection