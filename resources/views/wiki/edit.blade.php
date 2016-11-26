@extends('layouts.app')

@section('title')
    Edit Wiki {{ $wiki->title }}
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
    @if (Session::has('message'))
      <div class="ui success message">
        <div class="header">
          {{ Session::get('message') }}
        </div>
      </div>
    @endif   
    <h1>
      </a>Edit Wiki - {{ $wiki->title }}
      <form style="display: inline; float:right" action="{{ route('wiki.update', $wiki->id) }}" method="POST">
        {{ csrf_field() }}
        <div class="ui form">
          <div class="fields">
            <select name="status" class="ui search dropdown" required>
              <option value="">Select Status</option>
              @if ($wiki->status == 'published')
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
        <div class="inline fields">
          <div class="eleven wide field">
            <input name="title" type="text" placeholder="Title" value="{{ $wiki->title }}" required>
          </div>
          <div class="six wide field">
          <input type="hidden" name="tags" id="tags-real">
          <select id="tags" multiple="" class="ui dropdown">
            <option value="">Select Tags</option>
            @foreach ($tags as $tag)
              @if (in_array($tag->id, $selected))
                <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
              @else
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
              @endif
            @endforeach
            </select>
          </div>
        </div>
      </div>
      <textarea name="body" id="wiki-editor" required>{!! $wiki->body !!}</textarea>
    </div>
  </form>
  <form action="{{ route('wiki.destroy', $wiki->id) }}" method="POST">
    {{ csrf_field() }}
    <button type="submit" class="ui button red">Remove Wiki</button>
  </form>
  </div>
  <br>
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