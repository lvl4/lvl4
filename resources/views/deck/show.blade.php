@extends('layouts.master')

@section('title')
    {{ $deck->name }}
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-clone green"></i> {{ $deck->name }}</h1>
            <i>{{ date('j M Y', strtotime($deck->created_at)) }}</i>
            <br>
            <i>{{ count($cards) }} Cards</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="{{ route('portal.show', $portal->id) }}">{{ $portal->name }}</a></li>
                <li class="active">{{ $deck->name }}</li>
            </ol>
            <div class="content">
  
                <a href="{{ route('card.create', $deck->id) }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add Card</a>
                <a data-toggle="modal" data-target="#excel" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Import Cards via Excel</a>
                @if (Auth::user())
                    @if (Auth::user()->id == $deck->user_id)
                        <a href="{{ route('deck.edit', $deck->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Deck</a>
                        <form style="display:inline" action="{{ route('deck.destroy', $deck->id) }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="deck_id" value="{{ $deck->id }}">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Delete Deck</button>
                        </form>
                    @endif
                @endif

                @if (!$in_deck)
                    <form style="display:inline;" action="{{ route('bank.store') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="deck_id" value="{{ $deck->id }}">
                        <button type="submit" href="" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Add to Bank</button>
                    </form>
                @else
                    <a href="{{ route('review.show', $deck->id) }}" class="btn btn-success pull-right"><i class="fa fa-play" aria-hidden="true"></i> Start Quizz</a>
                @endif
                <p> </p>
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                @if ($errors->has('file'))
                    <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('file') }}</div>
                @endif
                <div class="card text-content light">
                    <h2>
                        <b>{{ $deck->name }}</b>
                    </h2>
                    <br>
                    @if (count($cards) > 0)
                        @foreach ($cards as $card)
                            <div class="card">
                            <div style="float: right;"class="buttons">
                                @if (Auth::user())
                                    @if (Auth::user()->id == $card->user_id)
                                        <form style="display: inline !important" action="{{ route('card.destroy', $card->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <button href="" class="btn btn-danger pull-right">Delete</button>
                                        </form>
                                        <a href="{{ route('card.edit', $card->id) }}" style="margin-right: 10px" class="btn btn-warning pull-right">Edit</a>
                                    @endif
                                @endif

                            </div>
                                <span>Question: {!! $card->question !!}</span>
                                    <p> </p> 
                                <span>Answer: {!! $card->answer !!}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">No cards have been created yet.</div>
                    @endif

                </div>
                <br>
            </div>
        </div> 
    </div>
@endsection

@section('extra')
    <div class="modal fade" id="excel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Import Cards via Excel file</h4>
          </div>
          <div class="modal-body">
            <form action="{{ route('card.import', $deck->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for=""><span class="red">*</span> Excel file (.xlsx)</label>
            <input type="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Import</button>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection