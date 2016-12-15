@extends('layouts.master')

@section('title')
    {{ $document->name }}
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-file-pdf-o green"></i> {{ $document->name }}</h1>
            <i>{{ $document->description }}</i>
            <br>
            <i>{{ date('j M Y', strtotime($document->created_at)) }}</i>
            <br>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}">All Portals</a></li>
                <li><a href="{{ route('portal.show', $portal->id) }}">{{ $portal->name }}</a></li>
                <li class="active">{{ $document->name }}</li>
            </ol>
            <div class="content">
                @if (Auth::user())
                    @if (Auth::user()->id == $document->user_id)
                        <a href="{{ route('document.edit', $document->id) }}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Document</a>
                    @endif
                @endif
                <p> </p>
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                <div class="card text-content">
                    <h2>
                        <b>{{ $document->name }}</b>
                    </h2>
                    <i>{{ $document->description }}</i>
                    <br>
                    <embed style="width: 100%; height: 900px" src="/storage/{{ $document->portal_id }}/{{ $document->location }}#toolbar=0&navpanes=0" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
                </div>
                <br>
            </div>
        </div> 
    </div>
@endsection