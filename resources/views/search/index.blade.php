@extends('layouts.app')

@section('title')
    Search results
@endsection

@section('content')
  <div class="fifteen wide column">
    <table class="ui striped table">
      <thead>
        <tr><th colspan="3">
          <h2>
            Search results for "{{ $search_term }}"
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
                <div class="header">No search results found.</div>
              </div>
            </td>
          </tr>
        @endif
      <tr>
      </tbody>
    </table>
  </div>
@endsection