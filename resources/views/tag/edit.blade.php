@extends('layouts.app')

@section('title')
    Edit Tag {{ $tag->name }}
@endsection

@section('content')
  <div class="sixteen wide column">
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
    <h1>
      </a>Edit Tag - {{ $tag->name }}
      <form style="display: inline; float:right" action="{{ route('tag.update', $tag->id) }}" method="POST">
        {{ csrf_field() }}
        <div class="ui form">
          <div class="fields">
              <button type="submit" style="margin-right: 7px; margin-left: 13px;" class="ui right floated button green">Save Changes</button>
          </div>
        </div>
    </h1>
    <div class="ui fluid segment">
      <div class="ui form">
        <div class="field">
            <input name="name" type="text" placeholder="Name" value="{{ $tag->name }}" required>
        </div>
      </div>
    </div>
  </form>
  <form action="{{ route('tag.destroy', $tag->id) }}" method="POST">
    {{ csrf_field() }}
    <button type="submit" class="ui button red">Remove Tag</button>
  </form>
  </div>
  <br>
@endsection

@section('scripts')
  <script>
    setInterval(function(){ 
      $('#wiki').val($('#wikis').val());
    }, 300);
  </script>
@endsection