@extends('layouts.master')

@section('title')
    Edit Portal
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-file-text-o green"></i> Edit {{ $portal->name }}</h1>
            <i>{{ $portal->description }}</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}">All Portals</a></li>
                <li><a href="{{ route('portal.show', $portal->id) }}">{{ $portal->name }}</a></li>
                <li class="active">Edit</li>
            </ol>
            <div class="content">
                <form action="{{ route('portal.update', $portal->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Save Changes</button>
                <a href="{{ route('portal.destroy', $portal->id) }}" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Delete Portal</a>
                <p> </p>
                <div class="card">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('name') }}</div>
                    @endif
                    @if ($errors->has('description'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('description') }}</div>
                    @endif
                    <h2><b>Edit Portal</b></h2>
                    <br>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $portal->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> Description</label>
                        <input type="text" name="description" class="form-control" value="{{ $portal->description }}" required>
                    </div>
                    </form>
                </div>
                <br>
            </div>
        </div> 
    </div>
@endsection