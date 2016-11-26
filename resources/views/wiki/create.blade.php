@extends('layouts.app')

@section('title')
    New Wiki
@endsection

@section('styles')
  <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
  <div class="sixteen wide column">
    @if ($errors->has('title'))
      <div class="ui error message">
        <div class="header">
          {{ $errors->first('title') }}
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
    @if ($errors->has('body'))
      <div class="ui error message">
        <div class="header">
          {{ $errors->first('body') }}
        </div>
      </div>
    @endif
    @if ($errors->has('tags'))
      <div class="ui error message">
        <div class="header">
          {{ $errors->first('tags') }}
        </div>
      </div>
    @endif
    <h1>
      New Wiki
      <form style="display: inline; float:right" action="{{ route('wiki.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="ui form">
          <div class="fields">
            <select name="status" class="ui search dropdown" required>
              <option value="">Select Status</option>
              <option value="published" selected>Published</option>
              <option value="unpublished">Unpublished</option>
            </select>
              <button type="submit" style="margin-right: 7px; margin-left: 13px;" class="ui right floated button green">Create</button>
          </div>
        </div>
    </h1>
    <div class="ui fluid segment">
      <div class="ui form">
        <div class="inline fields">
          <div class="eleven wide field">
            <input name="title" type="text" placeholder="Title" required>
          </div>
          <div class="six wide field">
          <input type="hidden" name="tags" id="tags-real">
          <select id="tags" multiple="" class="ui dropdown">
            <option value="">Select Tags</option>
            @foreach ($tags as $tag)
              <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
            </select>
          </div>
        </div>
      </div>
      <textarea name="body" id="wiki-editor" required></textarea>
    </div>
  </form>
  </div>
@endsection

@section('scripts')
  <script>
    CKEDITOR.replace( 'wiki-editor', {
      height: '35em'
    });

    setInterval(function(){ 
      $('#tags-real').val($('#tags').val());
      $('.cke_toolbar_break').hide();
    }, 300);
  </script>
@endsection