@extends('layouts.app')

@section('title')
    {{ $deck->name }}
@endsection

@section('content')
  <div class="sixteen wide column">
    @if (Session::has('message'))
      <div class="ui success message">
        <div class="header">
          {{ Session::get('message') }}
        </div>
      </div>
    @endif 
    <h1>Edit Cards</h1>
    <div class="ui fluid card">
      <div class="content">
        <div class="header">
          <h2>
            {{ $deck->name }}
          </h2>
        </div>
      </div>
      <div class="content">
        <div class="ui divided list">
          @if (count($cards) > 0)
            @foreach ($cards as $card)
              <div class="item">
                <i class="help icon"></i>
                <div class="content big-width">
                    <a href="{{ route('card.edit', $card->id) }}" class="ui mini button primary right floated">Edit</a>
                  <div class="header">
                    <h4>{!! $card->question !!}</h4>
                  </div>
                  <div class="description">{!! $card->answer !!}</div>
                </div>
              </div>
            @endforeach
          @else
            <div class="ui icon info message">
              <i class="clone icon"></i>
              <div class="content">
                <div class="header">
                  There are currently no cards for this deck
                </div>
                <p>Click <a href="{{ route('card.create') }}">here</a> to create one</p>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

