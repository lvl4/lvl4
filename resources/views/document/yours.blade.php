@extends('layouts.master')

@section('title')
    Your Documents
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-superpowers green"></i> Your Documents</h1>
            <i>All documents you've uploaded</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
              <li class="active">Your Documents</li>
            </ol>
            <div class="content">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                @if (count($documents) > 0)
                    @foreach ($documents as $document)
                        <div onclick="travel('{{ route('document.show', $document->id) }}')" class="card link-portal">
                            <div class="text">
                                <span class="title">{{ $document->name }}</span>
                                <br>
                                <span class="description">
                                    {{ $document->description }}
                                </span>
                            </div>
                            <div style="margin-top: 13px" class="buttons">
                                <span>{{ date('j M Y', strtotime($document->created_at)) }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card">
                        <div class="alert alert-info">You haven't uploaded any documents yet.</div>
                    </div>
                @endif
                <center>
                </center> 
            </div>
        </div> 
    </div>
@endsection