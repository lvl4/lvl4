@extends('layouts.app')

@section('title')
    Wikis
@endsection

@section('content')
  <div class="eleven wide column">
    <table class="ui striped table">
      <thead>
        <tr><th colspan="3">
          <h2>
            Recent Wikis
            @if (Auth::user()->role_id == 2)
              <a href="{{ route('wiki.create') }}" class="ui tiny right floated button green">New wiki</a>
            @endif
          </h2>
        </th>
      </tr></thead>
      <tbody>
        @if (count($wikis) > 0)  
          @foreach ($wikis as $wiki)
            <tr>
              <td>
                <a href="{{ route('wiki.show', [$wiki->id]) }}"><b>{{ $wiki->title }}</b></a>
                <br>
                Posted by: <a href="{{ route('account.show', $wiki->user_id) }}">{{ $wiki->user_username }}</a> | Tags: 
                @foreach ($wikiTags as $array => $value)
                   @if ($value['id'] == $wiki->id)
                     @if (count($value['tags'])  > 0)
                       @foreach ($value['tags'] as $tag)
                         
                       <div class="ui mini orange label">
                           {{$tag}}
                         </div>
                       @endforeach
                      @else
                        N/A
                     @endif
                   @endif
                @endforeach
              </td>
              <td class="right aligned">{{ date('j M Y', strtotime($wiki->created_at)) }}</td>
            </tr>
          @endforeach
        @else
          <tr>
            <td>
              <div class="ui message info">
                <div class="header">There are no wikis posted yet.</div>
              </div>
            </td>
          </tr>
        @endif
      <tr>
      </tbody>
        <tfoot>
          <tr>
            <th colspan="3">
              {{ $wikis->links() }}
            </th>
          </tr>
        </tfoot>
    </table>
  </div>
  <div class="five wide column">
    <div class="ui fluid card">
      <div class="content secondary-bg">
        <div class="header"><b>Your bank</b> <div style="float:right" class="ui mini red label">{{ $bank_count }}</div></div>
      </div>
      <div class="content">
        <div class="ui relaxed divided list">
          @if (count($banks) > 0)
            @foreach ($banks as $bank)
              <div class="item">
                <i class="large file text outline icon"></i>
                <div class="content">
                  <a href="{{ route('deck.show', $bank->id) }}" class="header">{{ $bank->name }}</a>
                  <div class="description">Added{{ date('j M Y', strtotime($bank->created_at)) }}</div>
                </div>
              </div>
            @endforeach
          @else
            <div class="ui icon info message">
              <i class="info icon"></i>
              <div class="content">
                <div class="header">
                  You have 0 decks in your bank
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
      @if (count($banks) > 0)
        <div class="extra content">
          <a href="{{ route('account.show', Auth::user()->id) }}" class="ui button fluid">Show all</a>
        </div>
      @endif
    </div>
{{-- 
    @if (Auth::user()->role_id == 2)
      <table class="ui celled  table">
        <thead>
          <tr><th>
            <h4>Your decks  <div style="float:right" class="ui mini grey  label">4</div></h4>
          </th>
        </tr></thead>
        <tbody>
          <tr>
            <td>
              <i class="large file text outline icon"></i> <a href=""><b>node_modules</b></a>
              <br>
              <i style="color: transparent;" class="large folder icon"></i> iejfiehfueofhieufgeiyg
            </td>
          </tr>
          <tr>
            <td>
              <i class="large file text outline icon"></i> <a href=""><b>node_modules</b></a>
              <br>
              <i style="color: transparent;" class="large folder icon"></i> iejfiehfueofhieufgeiyg
            </td>
          </tr>
          <tr>
            <td>
              <i class="large file text outline icon"></i> <a href=""><b>node_modules</b></a>
              <br>
              <i style="color: transparent;" class="large folder icon"></i> iejfiehfueofhieufgeiyg
            </td>
          </tr>
          <tr>
            <td>
              <i class="large file text outline icon"></i> <a href=""><b>node_modules</b></a>
              <br>
              <i style="color: transparent;" class="large folder icon"></i> iejfiehfueofhieufgeiyg
            </td>
          </tr>
        </tbody>
      </table>
    @endif --}}
  </div>
@endsection