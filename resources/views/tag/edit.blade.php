@extends('layouts.master')

@section('title')
    Edit Tag
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-file-text-o green"></i> edit {{ $tag->name }} tag</h1>
            <i>{{ date('j M Y', strtotime($tag->created_at)) }}</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="{{ route('tag.index') }}">Your Tags</a></li>
                <li style="color: white">{{ $tag->name }}</li>
                <li class="active">Edit Tag</li>
            </ol>
            <div class="content">
                <form action="{{ route('tag.update', $tag->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Save Changes</button>
                <p> </p>
                <div class="card">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('title') }}</div>
                    @endif
                    <h2><b>Edit Tag</b></h2>
                    <br>
                    <div class="col-md-12">
                        <label for=""><span class="red">*</span> Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $tag->name }}" required>
                    </div>
                <br>
            </div>
        </div> 
    </div>
@endsection