@extends('layouts.master')
@section('css')
    <style>
        body{
            background-image: url('img/background-header.jpg');
            background-size: cover;
        }
    </style>
@endsection
@section('title')
    Home
@endsection
@section('content')
<div style="margin-top: 5%" class="container">
    <center>
    <h1 style="font-weight: bold; color: white; font-size:60px; text-shadow: 3px 3px 17px rgba(0,0,0,0.8)">A <span style="color: #ffcd1f">simple</span> tool to learn <span style="color: #ffcd1f">anything</span></h1>
    </center>
    <br>
    <br>
    <div style="border-radius: 7px;padding: 15px; background: rgba(255,255,255,0.7)" class="card">
        <form action="{{ route('portal.search') }}">
            <input name="q" placeholder="Search Portals" style="font-size: 30px !important;padding-top: 30px;padding-bottom: 30px" type="text" class="form-control">
        </form>
    </div>
    <center>
        <a href="{{ route('portal.showall') }}" style="width: 240px; background-color: #6277d8; border-color: #576cc5; color:white" class="btn btn-default btn-xl ">View all portals</a>
        <a data-toggle="modal" data-target="#about" style="width: 240px; background-color: #ffcd1f; color: #4e3f08; border-color: #c29e2a;"class="btn btn-default btn-xl ">What is lvl4.org?</a>
    </center>

{{--     <div style="color: #333; font-size:15px;background-color: rgba(255,255,255,0.97);padding: 10px; border-radius: 3px;" class="intro">

    </div> --}}
</div>
@endsection

@section('extra')
<!-- Modal -->
<div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">What is lvl4.org?</h4>
      </div>
      <div class="modal-body">
        <p>
            Too much data, not enough time. That's the problem that lvl4.org aims to solve. 
        </p>
        <p>
            lvl4 (pronounced level four) is a web-site / software suite for learning boring things quickly. We all have things in our professional life that we need to memorize, bodies of knowledge that we need to understand thoroughly. Building flashcard decks is time consuming, and keeping them up-to-date isn't any easier. lvl4 allows users to quickly synthesize lots of info and memorize it error-free.
        </p>

        <p>
            Similar to wikipedia, everything submitted to public pages on lvl4.org is licensed under creative commons <a href="https://creativecommons.org/licenses/by-nc/4.0/">CC-BY NC 4.0</a>. Consider this the terms of use page until a lawyer writes a better one. Private pages, once they go live, will leave the licensing decision up to the user.
        </p>

        <p>
            In a similar vein, the website's source code is also available on lvl4's <a href="https://github.com/lvl4/lvl4">Github page</a>. If you're into that kind of thing, you can really think of lvl4 as a Github for textbooks and wikis.
        </p>

        <p>
            Which brings us to business model. Similar to Github, lvl4 pty ltd is a commercial enterprise. Like Github, we'll soon be rolling out commercial features such as private subject portals, where people can host corporate training programs, commercial textbooks and more. It will be a simple delineation: free hosting for creative commons, paid hosting for commercial content. <a href="http://www.joelonsoftware.com/articles/StrategyLetterV.html">Commoditize your complements and all that</a>.
        </p>

        <p>
            If you want to learn more, check out the <a href="https://github.com/lvl4/lvl4/wiki">wiki</a> on lvl4 Github. We hope you enjoy the site, and would love to hear your feedback at ian@lvl4.org
        </p>
      </div>
    </div>
  </div>
</div>
@endsection