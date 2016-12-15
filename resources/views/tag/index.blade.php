@extends('layouts.master')

@section('title')
    Your Tags
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-file-text-o green"></i> Your Tags</h1>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li class="active">Your Tags</li>
            </ol>
            <div class="content">
                <a href="{{ route('tag.create') }}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add Tag</a>
                <p> </p>
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                @if (count($tags) > 0)
                    @foreach ($tags as $tag)
                        <div class="card">
                        <div style="float: right;"class="buttons">
                            <form style="display: inline !important" action="{{ route('tag.destroy', $tag->id) }}" method="POST">
                                {{ csrf_field() }}
                                <button href="" class="btn btn-danger pull-right">Delete</button>
                            </form>
                            <a href="{{ route('tag.edit', $tag->id) }}" style="margin-right: 10px" class="btn btn-warning pull-right">Edit</a>
                        </div>
                            <span>{{ $tag->name }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="card">
                        <div class="alert alert-info">You haven't created any Tags yet.</div>
                    </div>
                @endif
                <br>
            </div>
        </div> 
    </div>
@endsection