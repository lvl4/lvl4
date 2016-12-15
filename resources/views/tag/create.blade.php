@extends('layouts.master')

@section('title')
    Create Tag
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-file-text-o green"></i> Create a new Tag</h1>
            {{-- <i>{{ date('j M Y', strtotime($tag->created_at)) }}</i> --}}
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="{{ route('tag.index') }}">Your Tags</a></li>
                <li class="active">Create Tag</li>
            </ol>
            <div class="content">
                <form action="{{ route('tag.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Create Tag</button>
                <p> </p>
                <div class="card">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('title') }}</div>
                    @endif
                    <h2><b>New Tag</b></h2>
                    <br>
                    <div class="col-md-12">
                        <label for=""><span class="red">*</span> Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                <br>
            </div>
        </div> 
    </div>
@endsection