@extends('layouts.master')

@section('title')
    Create Portal
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-file-text-o green"></i> Create a new Portal</h1>
            {{-- <i>{{ date('j M Y', strtotime($wiki->created_at)) }}</i> --}}
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}">All Portals</a></li>
                <li class="active">Create Portal</li>
            </ol>
            <div class="content">
                <form action="{{ route('portal.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Create Portal</button>
                <p> </p>
                <div class="card">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('name') }}</div>
                    @endif
                    @if ($errors->has('description'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('description') }}</div>
                    @endif
                    <h2><b>Create Portal</b></h2>
                    <br>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for=""><span class="red">*</span> Description</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>
                    </form>
                </div>
                <br>
            </div>
        </div> 
    </div>
@endsection