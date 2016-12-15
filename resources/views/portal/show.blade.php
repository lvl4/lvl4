@extends('layouts.master')

@section('title')
    {{ $portal->name }}
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-superpowers green"></i> {{ $portal->name }}</h1>
            <i>{{ $portal->description }}</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                @if (Auth::user())
                    <li><a href="{{ route('dashboard.index') }}">All Portals</a></li>
                @else
                    <li><a href="{{ route('portal.showall') }}">All Portals</a></li>
                @endif
                <li class="active">{{ $portal->name }}</li>
            </ol>
            <div class="content">
                <a href="{{ route('wiki.create', $portal->id) }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> New Wiki</a>
                <a href="{{ route('deck.create', $portal->id) }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> New Deck</a>
                <a class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-clone" aria-hidden="true"></i> View Decks</a>
                <a href="{{ route('document.create', $portal->id) }}" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> Upload Document</a>
                @if (Auth::user())
                    @if (Auth::user()->id == $portal->user_id)
                        <a href="{{ route('portal.edit', $portal->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Portal</a>
                    @endif
                @endif
                <p> </p>
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                <div class="card light">
                    <h2><b>Wikis</b></h2>
                    <br>
                    @if (count($wikis) > 0)
                        @foreach ($wikis as $wiki)
                            <div style="width: 100%" class="card no-mar link-wiki" onclick="travel('{{ route('wiki.show', $wiki->id) }}')">
                                <div class="text">
                                    {{ $wiki->title }}
                                </div>
                                <span class="date pull-right">{{ date('j M Y', strtotime($wiki->created_at)) }}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">No wikis have been created yet.</div>
                    @endif
                </div>
                <br>
                <div class="card light">
                    <h2><b>Documents</b></h2>
                    <br>
                    @if (count($documents) > 0)
                        @foreach ($documents as $document)
                            <div style="width: 100%" class="card no-mar link-wiki" onclick="travel('{{ route('document.show', $document->id) }}')">
                                <div class="text">
                                    {{ $document->name }}
                                </div>
                                <br>
                                <i>{{ $document->description }}</i>
                                <span class="date pull-right slight-mar-top">{{ date('j M Y', strtotime($document->created_at)) }}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">No documents have been uploaded yet.</div>
                    @endif
                </div>
            </div>
        </div> 
    </div>
@endsection

@section('extra')
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Decks</h4>
          </div>
          <div class="modal-body light">
            @if (count($decks) > 0)
                @foreach ($decks as $deck)
                    <div style="width: 100%" class="card no-mar link-wiki" onclick="travel('{{ route('deck.show', $deck->id) }}')">
                        <div class="text">
                            {{ $deck->name }}
                        </div>
                    </div>
                    <p> </p>
                @endforeach
            @else
                <div class="alert alert-info">No decks have been created yet.</div>
            @endif
          </div>
        </div>
      </div>
    </div>
@endsection