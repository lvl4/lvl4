@extends('layouts.app')

@section('title')
    Edit Card
@endsection

@section('styles')
  <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
  <div class="sixteen wide column">
    @if ($errors->has('question'))
      <div class="ui error message">
        <div class="header">
          {{ $errors->first('question') }}
        </div>
      </div>
    @endif
    @if ($errors->has('answer'))
      <div class="ui error message">
        <div class="header">
          {{ $errors->first('answer') }}
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
    @if ($errors->has('deck_id'))
      <div class="ui error message">
        <div class="header">
          {{ $errors->first('deck_id') }}
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
      Edit Card
      <form style="display: inline; float:right" action="{{ route('card.update', $card->id) }}" method="POST">
        {{ csrf_field() }}
        <div class="ui form">
          <div class="fields">
          <select name="deck_id" class="ui search dropdown longer" required>
            <option value="">Select Deck</option>
            @foreach ($decks as $deck) 
              @if ($card->deck_id == $deck->id)
                <option value="{{ $deck->id }}" selected>{{ $deck->name }}</option>
              @else
                <option value="{{ $deck->id }}">{{ $deck->name }}</option>
              @endif
            @endforeach
          </select>
            <select name="status" class="ui search dropdown pad-left" required>
              <option value="">Select Status</option>
              @if ($card->status == 'published')
                <option value="published" selected>Published</option>
                <option value="unpublished">Unpublished</option>
              @else
                <option value="published">Published</option>
                <option value="unpublished" selected>Unpublished</option>
              @endif
            </select>
              <button type="submit" style="margin-right: 7px; margin-left: 13px;" class="ui right floated button green">Save changes</button>
          </div>

        </div>
    </h1>
    <div class="ui fluid segment">
      <div style="margin: 0px !important" class="ui grid">
        <div class="eight wide column">
          <h3>Question</h3>
          <textarea name="question" id="wiki-question" required>{!! $card->question !!}</textarea>
        </div>
        <div class="eight wide column">
          <h3>Answer</h3>
          <textarea name="answer" id="wiki-answer" required>{!! $card->answer !!}</textarea>
        </div>
      </div>
    </div>
  </form>
  <form action="{{ route('card.destroy', $card->id) }}" method="POST">
    {{ csrf_field() }}
    <button type="submit" class="ui button red">Remove card</button>
  </form>
  </div>
@endsection

@section('scripts')
  <script>
    // CKEDITOR.replace( 'wiki-editor', {
    //   height: '35em'
    // });
          
    CKEDITOR.replace( 'wiki-question', {
      height: '25em'
    });

    CKEDITOR.replace( 'wiki-answer', {
      height: '25em'
    });


    // setInterval(function(){ 
    //   $('#tags-real').val($('#tags').val());
    //   $('.cke_toolbar_break').hide();
    // }, 300);
  </script>
@endsection