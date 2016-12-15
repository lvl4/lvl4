@extends('layouts.master')

@section('title')
    Create Deck
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-clone green"></i> Create a new Deck</h1>
            <i>{{ $portal->name }}</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}">All Portals</a></li>
                <li><a href="{{ route('portal.show', $portal->id) }}">{{ $portal->name }}</a></li>
                <li class="active">Create Deck</li>
            </ol>
            <div class="content">
                <form action="{{ route('deck.store') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="portal_id" value="{{ $portal->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Create Deck</button>
                <p> </p>
                <div class="card">
                    @if ($errors->has('name'))
                        <div class="alert alert-danger" role="alert"><b>Whoops! </b> {{ $errors->first('name') }}</div>
                    @endif
                    <h2><b>Create Deck</b></h2>
                    <br>
                    <div class="col-md-12">
                        <label for=""><span class="red">*</span> Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    </form>
                </div>
                <br>
            </div>
        </div> 
    </div>
@endsection