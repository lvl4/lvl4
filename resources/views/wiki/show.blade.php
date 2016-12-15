@extends('layouts.master')

@section('title')
    {{ $wiki->title }}
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-file-text-o green"></i> {{ $wiki->title }}</h1>
            <i>{{ date('j M Y', strtotime($wiki->created_at)) }}
            @if ($wiki->status == 'unpublished')
                <span style="margin-left: 15px;" class="label label-danger">{{ $wiki->status }}</span>
            @endif
            </i>
            <br>
            @foreach ($tags as $tag)
                <span class="label label-dark">{{$tag->name}}</span>
            @endforeach
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                @if (Auth::user())
                    <li><a href="{{ route('dashboard.index') }}">All Portals</a></li>
                @else
                    <li><a href="{{ route('portal.showall') }}">All Portals</a></li>
                @endif
                <li><a href="{{ route('portal.show', $portal->id) }}">{{ $portal->name }}</a></li>
                <li class="active">{{ $wiki->title }}</li>
            </ol>
            <div class="content">
                @if (Auth::user())
                    @if (Auth::user()->id == $wiki->user_id)
                        <a href="{{ route('wiki.edit', $wiki->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Wiki</a>
                    @endif
                @endif
                <p> </p>
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                <div style="background: white; padding: 10px; border-radius: 2px;">
                    <h2>
                        <b>{{ $wiki->title }}</b>
                    </h2>
                    <br>
                    {!! $wiki->body !!}
                </div>
                <br>
            </div>
        </div> 
    </div>
@endsection
