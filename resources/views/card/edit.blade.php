@extends('layouts.master')

@section('title')
    Edit Card
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-sticky-note-o green"></i> Edit an existing Card</h1>
            {{-- <i>{{ date('j M Y', strtotime($wiki->created_at)) }}</i> --}}
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="{{ route('deck.show', $deck->id) }}">{{ $deck->name }}</a></li>
                <li class="active">Edit Card</li>
            </ol>
            <div class="content">
                <form action="{{ route('card.update', $card->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="deck_id" value="{{ $deck->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Save Changes</button>
                <p> </p>
                <div class="card">
                    @if ($errors->has('question'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('question') }}</div>
                    @endif
                    @if ($errors->has('answer'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('answer') }}</div>
                    @endif
                    <h2><b>Edit Card</b></h2>
                    <br>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> Question</label>
                        <textarea name="question" id="editor" required>{{ $card->question }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> Answer</label>
                        <textarea name="answer" id="editor-1" required>{{ $card->answer }}</textarea>
                    </div>
                    </form>
                </div>
                <br>
            </div>
        </div> 
    </div>
@endsection