@extends('layouts.master')

@section('title')
    All Portals
@endsection

@section('content')
    <div class="container-fluid body">
        @include('partials.sidebar')
        <div class="content-header">
            <h1><i class="fa fa-superpowers green"></i> All Portals</h1>
            <i>All public portals</i>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
              <li class="active">All Portals</li>
            </ol>
            <div class="content">
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @endif
                <a href="{{ route('portal.create') }}" class="btn btn-success pull-left"><i class="fa fa-plus" aria-hidden="true"></i> Create Portal</a>
                <form style="margin-bottom: 6px;" action="{{ route('portal.search') }}" method="GET">
                    <div class="input-group">
                    <input style="width: 300px" type="text" name="q" class="form-control pull-right" placeholder="Search for..." required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary pull-right" type="button">Search Portals</button>
                    </span> 
                </form>
                  </div>
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
                <center>
                    {{ $portals->links() }}
                </center> 
            </div>
        </div> 
    </div>
@endsection