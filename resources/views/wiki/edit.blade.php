@extends('layouts.master')

@section('title')
    Edit Wiki
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-file-text-o green"></i> Edit an existing Wiki</h1>
            <i>{{ $wiki->title }}</i>
            <br>
            <i>{{ date('j M Y', strtotime($wiki->created_at)) }}</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}">All Portals</a></li>
                <li><a href="{{ route('portal.show', $portal->id) }}">{{ $portal->name }}</a></li>
                <li><a href="{{ route('wiki.show', $wiki->id) }}">{{ $wiki->title }}</a></li>
                <li class="active">Edit Wiki</li>
            </ol>
            <div class="content">
                <form action="{{ route('wiki.update', $wiki->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="portal_id" value="{{ $portal->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Save Changes</button>
                <a href="{{ action('WikiController@destroy', $wiki->id) }}" type="button" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Delete Wiki</a>
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
                    <h2><b>Edit {{ $wiki->title }}</b></h2>
                    <br>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $wiki->title }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for=""><span class="red">*</span> Tags</label>
                        <select name="tags[]" id="" class="select2  form-control" multiple="multiple" required>
                            @foreach ($tags as $tag)
                                @if (in_array($tag->id, $selectedTags))
                                    <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @else
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for=""><span class="red">*</span> Status</label>
                        <select name="status" id="" class="form-control" required>
                            @if ($wiki->status == 'published')
                                <option selected value="published">Published</option>
                                <option value="unpublished">Unpublished</option>
                            @else
                                <option value="published">Published</option>
                                <option selected value="unpublished">Unpublished</option>
                            @endif
                        </select>
                    </div>
                    <p> </p>
                    <p> </p>
                    <div class="col-md-12">
                        <label for=""><span class="red">*</span> Body</label>
                        <textarea name="body" id="editor" class="editor" required>{!! $wiki->body !!}</textarea>
                    </div>
                    </form>
                </div>
                <br>
            </div>
        </div> 
    </div>
@endsection