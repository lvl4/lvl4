@extends('layouts.master')

@section('title')
    Your Portals
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-superpowers green"></i> Your Portals</h1>
            <i>All portals you've created</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
              <li class="active">Your Portals</li>
            </ol>
            <div class="content">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                <a href="{{ route('portal.create') }}" class="btn btn-success pull-left"><i class="fa fa-plus" aria-hidden="true"></i> Create Portal</a>
                <br>
                <br>
                @if (count($portals) > 0)
                    @foreach ($portals as $portal)
                        <div onclick="travel('{{ route('portal.show', $portal->id) }}')" class="card link-portal">
                            <div class="text">
                                <span class="title">{{ $portal->name }}</span>
                                <br>
                                <span class="description">{{ $portal->description }}</span>
                            </div>
                            <div style="margin-top: 13px" class="buttons">
                                <span>{{ date('j M Y', strtotime($portal->created_at)) }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card">
                        <div class="alert alert-info">You haven't created any portals yet.</div>
                    </div>
                @endif
                <center>
                </center> 
            </div>
        </div> 
    </div>
@endsection