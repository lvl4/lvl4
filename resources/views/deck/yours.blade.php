@extends('layouts.master')

@section('title')
    Your Decks
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-superpowers green"></i> Your Decks</h1>
            <i>All decks you've created</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
              <li class="active">Your Decks</li>
            </ol>
            <div class="content">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                @if (count($decks) > 0) 
                    @foreach ($decks as $deck)
                        <div onclick="travel('{{ route('deck.show', $deck->id) }}')" class="card link-portal">
                            <div class="text">
                                <span class="title">{{ $deck->name }}</span>
                                <br>
                            </div>
                            <div style="margin-top: 4px" class="buttons">
                                <span>{{ date('j M Y', strtotime($deck->created_at)) }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card">
                        <div class="alert alert-info">You haven't created any Decks yet.</div>
                    </div>
                @endif
                <center>
                </center> 
            </div>
        </div> 
    </div>
@endsection