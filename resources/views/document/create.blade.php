@extends('layouts.master')

@section('title')
    Upload Document
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-file-pdf-o green"></i> Upload a new Document</h1>
            <i>{{ $portal->name }}</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}">All Portals</a></li>
                <li><a href="{{ route('portal.show', $portal->id) }}">{{ $portal->name }}</a></li>
                <li class="active">Upload Document</li>
            </ol>
            <div class="content">
                <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="portal_id" value="{{ $portal->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-success"><i class="fa fa-upload" aria-hidden="true"></i> Upload Document</button>
                <p> </p>
                <div class="card">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('name') }}</div>
                    @endif
                    @if ($errors->has('description'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('description') }}</div>
                    @endif
                    <h2><b>Upload Document</b></h2>
                    <br>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> Description</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>
                    <div style="margin-top: 15px" class="col-md-2">
                        <label for=""><span class="red">*</span> Document</label>
                        <input type="file" name="document" accept="application/pdf" required>
                    </div>
                    </form>
                </div>
                <br>
            </div>
        </div> 
    </div>
@endsection