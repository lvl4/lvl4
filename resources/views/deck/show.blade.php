@extends('layouts.app')

@section('title')
    {{ $deck->name }}
@endsection

@section('content')
  <div class="sixteen wide column">

    @if (session()->has('message-success'))
      <div class="ui success message">
        <i class="close icon"></i>
        <div class="header">
          "{{ $deck->name }}" has been added to your bank.
        </div>
        <p>{{ session('message-success') }}</p>
      </div>
    @endif

    <div class="ui fluid card">
      <div class="content">
        <div class="header">
          <h2>{{ $deck->name }}
            @if (!$inBank)
              <form style="margin:0;padding:0;display:inline;" method="POST" action="{{ route('bank.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="deck_id" value="{{ $deck->id }}">
                <button type="submit" class="ui tiny right floated labeled icon button green"><i class="plus icon"></i>Add to bank</button>
              </form>
            @else
                <a href="{{ route('card.show', $deck->id) }}" class="ui tiny right floated labeled icon button green "><i class="play icon"></i>START</a>
            @endif
          </h2>
        </div>
      </div>
      <div class="content">
        <div class="ui divided list">
          @if (count($cards) > 0)
            @foreach ($cards as $card)
              <div class="item">
                <i class="help icon"></i>
                <div class="content">
                  <div class="header"><h4>{!! $card->question !!}</h4></div>
                  <div class="description">{!! $card->answer !!}</div>
                </div>
              </div>
            @endforeach
          @else
            <div class="ui info message">
              <div class="header">
                There are currently no cards for this deck.
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

