@extends('layouts.master')

@section('title')
    Your Wikis
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-superpowers green"></i> Your Wikis</h1>
            <i>All wikis you've created</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
              <li class="active">Your Wikis</li>
            </ol>
            <div class="content">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                @if (count($wikis) > 0)
                    @foreach ($wikis as $wiki)
                        <div onclick="travel('{{ route('wiki.show', $wiki->id) }}')" class="card link-portal">
                            <div class="text">
                                <span class="title">{{ $wiki->title }}</span>
                                <br>
                                <span style="font-style: normal !important" class="description">
                                    @foreach ($wiki_tags as $wiki_id => $tags)
                                        @if ($wiki->id == $wiki_id)
                                            @if (count($tags) > 0)
                                                @foreach ($tags as $tag)
                                                    <span class="label label-green">{{ $tag }}</span>
                                                @endforeach
                                            @else
                                                <span style="font-size: 11px;">No tags</span>
                                            @endif
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                            <div style="margin-top: 13px" class="buttons">
                                <span>{{ date('j M Y', strtotime($wiki->created_at)) }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card">
                        <div class="alert alert-info">You haven't created any Wikis yet.</div>
                    </div>
                @endif
                <center>
                </center> 
            </div>
        </div> 
    </div>
@endsection