@extends('layouts.app')

@section('title')
    {{ $wiki->title }}
@endsection

@section('content')
  <div class="sixteen wide column">
    <div class="ui fluid card">
      <div class="content">
        <div class="header"><h2>{{ $wiki->title }} <a onclick="viewDecksModal()" class="ui tiny right floated button primary">View decks</a></h2></div>
      </div>
      <div class="content">
        {!! $wiki->body !!}
      </div>
    </div>
  </div>

  {{-- modal --}}
  <div class="ui modal viewDecks">
    <i class="close icon"></i>
    <div class="header">
      Available decks
    </div>
    <div class="image content">
      <div class="description">
        <div class="ui relaxed divided list">
          @if (count($decks) > 0)
            @foreach ($decks as $deck)
              <div class="item">
                <i class="large file text outline  icon"></i>
                <div class="content">
                  <a href="{{ route('deck.show', $deck->id) }}" class="header">{{ $deck->name }}</a>
                  <div class="description">Last updated on {{ date('j M Y', strtotime($deck->updated_at)) }}</div>
                </div>
              </div>
            @endforeach
          @else
            <div class="ui icon info message">
              <i class="info icon"></i>
              <div class="content">
                <div class="header">
                  There are currently no decks for this wiki.
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

