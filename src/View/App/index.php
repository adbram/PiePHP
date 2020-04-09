<header class="row">
    <h1 class="col-md-6">MyCinema</h1>
    <nav class="col-md-6">
        <ul class="row">
            <li class="col-md-2"><a href="#">FILMS</a></li>
            <li class="col-md-3"><a href="#">GENRES</a></li>
            <li class="col-md-4"><a href="#">HISTORIQUE</a></li>
            <li class="col-md-3"><a href="#">MON PROFIL</a></li>
        </ul>
    </nav>
</header>

<section class="row">
    <form class="row col-12" action="search/page/1" method="get" id="searchBar">
        <input type="text" name="s" id="search" class="col-11" maxlength="50"  placeholder="Rechercher...">
        <button type="submit" form="searchBar" id="submitSearch" class="col-1"><i class="fas fa-search"></i></button>
    </form>
    @foreach($films as $key => $film)
        <div class="movieCard col-6 col-md-3" data-id="{{$film->id}}">
            @if($film->poster == NULL)
                <img src="webroot/assets/noImage.png">
            @else
            <img src="data:image/png;base64, {{$film->poster}}" width=150>
            @endif
        <h3>{{$film->titre}}</h1>
        </div>
    @endforeach
    <div class="col-12 pagesNav">
        @for($i = 1 ; $i <= $nbPages ; $i++)
            @if($currentPage != $i)
                <a class="nbPage" href="{{preg_replace([BASE_URI.'\//', '/\/page\/(.*)/'], '', $_SERVER['REQUEST_URI']) . '/page/'.$i}}"> {{$i}} </a>
            @else
                <span class="currentPage nbPage">{{$i}}</span>
            @endif
        @endfor
    </div>
</section>

<footer>

</footer>