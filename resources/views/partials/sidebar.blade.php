<div class="col-md-3">
    <div class="sidebar top-pad">
            <ul>
               @if (Auth::user())
                   @if (Request::route()->getName() == 'dashboard.index')
                       <a class="active" href="{{ route('dashboard.index') }}"><li><i class="fa fa-superpowers" aria-hidden="true"></i> All Portals</li></a>
                   @elseif(Request::route()->getName() == 'portal.index')
                       <a class="active" href="{{ route('dashboard.index') }}"><li><i class="fa fa-superpowers" aria-hidden="true"></i> All Portals</li></a>
                   @elseif(Request::route()->getName() == 'wiki.show')
                       <a class="active" href="{{ route('dashboard.index') }}"><li><i class="fa fa-superpowers" aria-hidden="true"></i> All Portals</li></a>
                   @elseif(Request::route()->getName() == 'deck.show')
                       <a class="active" href="{{ route('dashboard.index') }}"><li><i class="fa fa-superpowers" aria-hidden="true"></i> All Portals</li></a>
                   @elseif(Request::route()->getName() == 'portal.show')
                       <a class="active" href="{{ route('dashboard.index') }}"><li><i class="fa fa-superpowers" aria-hidden="true"></i> All Portals</li></a>
                   @else
                       <a href="{{ route('dashboard.index') }}"><li><i class="fa fa-superpowers" aria-hidden="true"></i> All Portals</li></a>
                   @endif
                @else
                   <a href="{{ route('portal.showall') }}"><li><i class="fa fa-superpowers" aria-hidden="true"></i> All Portals</li></a>
               @endif
            </ul>
        <hr>
        <h4>Your Content</h4>
        <ul>
            @if (Request::route()->getName() == 'portal.yours')
                <a class="active" href="{{ route('portal.yours') }}"><li><i class="fa fa-superpowers" aria-hidden="true"></i> Your Portals</li></a>
            @else
                <a href="{{ route('portal.yours') }}"><li><i class="fa fa-superpowers" aria-hidden="true"></i> Your Portals</li></a>
            @endif

            @if (Request::route()->getName() == 'bank.index')
                <a class="active" href="{{ route('bank.index') }}"><li><i class="fa fa-files-o" aria-hidden="true"></i> Your Bank</li></a>
            @else
                <a href="{{ route('bank.index') }}"><li><i class="fa fa-files-o" aria-hidden="true"></i> Your Bank</li></a>
            @endif

            @if (Request::route()->getName() == 'wiki.yours')
                <a class="active" href="{{ route('wiki.yours') }}"><li><i class="fa fa-file-text-o" aria-hidden="true"></i> Your Wikis</li></a>
            @else
                <a href="{{ route('wiki.yours') }}"><li><i class="fa fa-file-text-o" aria-hidden="true"></i> Your Wikis</li></a>
            @endif

            @if (Request::route()->getName() == 'deck.yours')
                <a class="active" href="{{ route('deck.yours') }}"><li><i class="fa fa-clone" aria-hidden="true"></i> Your Decks</li></a>
            @else
                <a href="{{ route('deck.yours') }}"><li><i class="fa fa-clone" aria-hidden="true"></i> Your Decks</li></a>
            @endif

            @if (Request::route()->getName() == 'document.yours')
                <a class="active" href="{{ route('document.yours') }}"><li><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Your Documents</li></a>
            @else
               <a href="{{ route('document.yours') }}"><li><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Your Documents</li></a>
            @endif

            @if (Request::route()->getName() == 'tag.index')
                <a href="{{ route('tag.index') }}" class="active" href=""><li><i class="fa fa-tags" aria-hidden="true"></i> Your Tags</li></a>
            @elseif(Request::route()->getName() == 'tag.edit')
                <a href="{{ route('tag.index') }}" class="active" href=""><li><i class="fa fa-tags" aria-hidden="true"></i> Your Tags</li></a>
            @elseif(Request::route()->getName() == 'tag.crete')
                <a href="{{ route('tag.index') }}" class="active" href=""><li><i class="fa fa-tags" aria-hidden="true"></i> Your Tags</li></a>
            @else
                <a href="{{ route('tag.index') }}"><li><i class="fa fa-tags" aria-hidden="true"></i> Your Tags</li></a>
            @endif
        </ul>
        <hr>
        <h4>Your Settings</h4>
        <ul>
            @if (Request::route()->getName() == 'setting.index')
                <a class="active" href="{{ route('setting.index') }}"><li><i class="fa fa-cog" aria-hidden="true"></i> Settings</li></a>
            @else
                <a href="{{ route('setting.index') }}"><li><i class="fa fa-cog" aria-hidden="true"></i> Settings</li></a>
            @endif
        </ul>
    </div>
</div>