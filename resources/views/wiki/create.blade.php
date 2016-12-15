@extends('layouts.master')

@section('title')
    Create Wiki
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-file-text-o green"></i> Create a new Wiki</h1>
            {{-- <i>{{ date('j M Y', strtotime($wiki->created_at)) }}</i> --}}
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}">All Portals</a></li>
                <li><a href="{{ route('portal.show', $portal->id) }}">{{ $portal->name }}</a></li>
                <li class="active">Create Wiki</li>
            </ol>
            <div class="content">
                <form action="{{ route('wiki.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="portal_id" value="{{ $portal->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Save Wiki</button>
                <p> </p>
                <div class="card">
                    @if ($errors->has('title'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('title') }}</div>
                    @endif
                    @if ($errors->has('tags'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('tags') }}</div>
                    @endif
                    @if ($errors->has('status'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('status') }}</div>
                    @endif
                    @if ($errors->has('body'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('body') }}</div>
                    @endif
                    <h2><b>Create Wiki</b></h2>
                    <br>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for=""><span class="red">*</span> Tags</label>
                        <select name="tags[]" id="" class="select2  form-control" multiple="multiple" required>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for=""><span class="red">*</span> Status</label>
                        <select name="status" id="" class="form-control" required>
                            <option value="published">Published</option>
                            <option value="unpublished">Unpublished</option>
                        </select>
                    </div>
                    <p> </p>
                    <p> </p>
                    <div class="col-md-12">
                        <label for=""><span class="red">*</span> Body</label>
                        <textarea name="body" id="editor" class="editor" required></textarea>
                    </div>
                    </form>
                </div>
                <br>
            </div>
        </div> 
    </div>
@endsection