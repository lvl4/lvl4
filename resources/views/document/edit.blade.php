@extends('layouts.master')

@section('title')
    Edit Document
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-file-text-o green"></i> Edit {{ $document->name }}</h1>
            <i>{{ $document->description }}</i>
            <br>
            <i>{{ date('j M Y', strtotime($document->created_at)) }}</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}">All Portals</a></li>
                <li><a href="{{ route('portal.show', $portal->id) }}">{{ $portal->name }}</a></li>
                <li><a href="{{ route('document.show', $document->id) }}">{{ $document->name }}</a></li>
                <li class="active">Edit Document</li>
            </ol>
            <div class="content">
                <form action="{{ route('document.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="portal_id" value="{{ $portal->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Save Changes</button>
                <a href="{{ action('DocumentController@destroy', $document->id) }}" type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Delete Document</a>
                <p> </p>
                <div class="card">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('name') }}</div>
                    @endif
                    @if ($errors->has('description'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('description') }}</div>
                    @endif
                    <h2><b>Edit {{ $document->name }}</b></h2>
                    <br>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $document->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> Description</label>
                        <input type="text" name="description" class="form-control" value="{{ $document->description }}" required>
                    </div>
                    <div style="margin-top: 15px;" class="col-md-12">
                        <label for="">Document</label>
                        <input type="file" name="document" accept="application/pdf">
                    </div>
                    </form>
                </div>
                <br>
            </div>
        </div> 
    </div>
@endsection