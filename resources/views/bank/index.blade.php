@extends('layouts.master')

@section('title')
    Your Bank
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-superpowers green"></i> Your Bank</h1>
            <i>All decks in your bank</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
              <li class="active">Your Bank</li>
            </ol>
            <div class="content">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                @if (count($banks) > 0)
                    @foreach ($banks as $bank)
                        <div onclick="travel('{{ route('deck.show', $bank->id) }}')" class="card link-portal">
                            <div class="text">
                                <span class="title">{{ $bank->name }}</span>
                                <br>
                                <span style="font-style: normal !important" class="description">
                                    Added on {{ date('j M Y', strtotime($bank->bank_created_at)) }}
                                </span>
                            </div>
                            <div style="margin-top: 4px" class="buttons">
                                <a href="{{ action('BankController@destroy', $bank->id) }}" class="btn btn-danger"><i class="fa fa-times"></i> Remove from Bank</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card">
                        <div class="alert alert-info">There are no decks in your Bank yet.</div>
                    </div>
                @endif
                <center>
                </center> 
            </div>
        </div> 
    </div>
@endsection