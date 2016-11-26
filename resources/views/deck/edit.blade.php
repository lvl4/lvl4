@extends('layouts.app')

@section('title')
    Edit Deck {{ $deck->name }}
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
    @if ($errors->has('status'))
      <div class="ui error message">
        <div class="header">
          {{ $errors->first('status') }}
        </div>
      </div>
    @endif
    @if ($errors->has('wiki'))
      <div class="ui error message">
        <div class="header">
          {{ $errors->first('wiki') }}
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
      </a>Edit Deck - {{ $deck->name }}
      <form style="display: inline; float:right" action="{{ route('deck.update', $deck->id) }}" method="POST">
        {{ csrf_field() }}
        <div class="ui form">
          <div class="fields">
            <select name="status" class="ui search dropdown" required>
              <option value="">Select Status</option>
              @if ($deck->status == 'published')
                <option value="published" selected>Published</option>
                <option value="unpublished">Unpublished</option>
              @else
                <option value="published">Published</option>
                <option value="unpublished" selected>Unpublished</option>
              @endif
            </select>
              <button type="submit" style="margin-right: 7px; margin-left: 13px;" class="ui right floated button green">Save Changes</button>
          </div>
        </div>
    </h1>
    <div class="ui fluid segment">
      <div class="ui form">
        <div class="two fields">
          <div class="field">
            <label for="">Name</label>
            <input name="name" type="text" placeholder="Name" value="{{ $deck->name }}" required>
          </div>
          <div class="field">
            <label for="">Wiki</label>
            <input id="wiki" type="hidden" name="wiki">
            <select id="wikis" class="ui search dropdown">
              <option value="">Select Status</option>
                @foreach ($wikis as $wiki)
                  @if ($wiki->id == $deck->wiki_id)
                    <option value="{{ $wiki->id }}" selected>{{ $wiki->title }}</option>
                  @else
                    <option value="{{ $wiki->id }}">{{ $wiki->title }}</option>
                  @endif
                @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
  </form>
  <form action="{{ route('deck.destroy', $deck->id) }}" method="POST">
    {{ csrf_field() }}
    <button type="submit" class="ui button red">Remove Deck</button>
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