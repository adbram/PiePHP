<header class="row">
    <h1 class="col-md-6">MyCinema</h1>
    <nav class="col-md-6">
        <ul class="row">
            <li class="col-md-2"><a href="#">FILMS</a></li>
            <li class="col-md-2"><a href="genres">GENRES</a></li>
            <li class="col-md-5"><a href="monprofil">PROFIL &amp; HISTORIQUE</a></li>
            <li class="col-md-4"><a href="deconnexion">DECONNEXION</a></li>
        </ul>
    </nav>
</header>

<section class="row">
    <form class="col-12" action="search/page/1" method="get" id="searchForm">
        <div class="col-12" id="searchBar">
            <input type="text" name="s" id="search" class="col-11" maxlength="50"  placeholder="Rechercher...">
            <button type="submit" form="searchForm" id="submitSearch" class="col-1"><i class="fas fa-search"></i></button>
        </div>
        <p id="showGenre" class="col-3">Genres</p>
        <div class="col-12  offset-9" id="genre">
            <div class="option"><input type="checkbox" name="Action" data-g="Action" id="Action"><label  for="Action">Action</label></div>
            <div class="center option"><input type="checkbox" name="Science_fiction" data-g="Science fiction" id="Science_fiction"><label for="Science_fiction">Science fiction</label></div><br>
            <div class="option"><input type="checkbox" name="Drame" data-g="Drame" id="Drame"><label  for="Drame">Drame</label></div>
            <div class="center option"><input type="checkbox" name="Animation" data-g="Animation" id="Animation"><label for="Animation">Animation</label></div><br>
            <div class="option"><input type="checkbox" name="Police" data-g="Police" id="Police"><label  for="Police">Police</label></div>
            <div class="center option"><input type="checkbox" name="Comedie" data-g="Comedie" id="Comedie"><label for="Comedie">Comedie</label></div><br>
            <div class="option"><input type="checkbox" name="Thriller" data-g="Thriller" id="Thriller"><label  for="Thriller">Thriller</label></div>
            <div class="center option"><input type="checkbox" name="Aventure" data-g="Aventure" id="Aventure"><label for="Aventure">Aventure</label></div><br>
            <div class="option"><input type="checkbox" name="Romance" data-g="Romance" id="Romance"><label  for="Romance">Romance</label></div>
            <div class="center option"><input type="checkbox" name="Musique" data-g="Musique" id="Musique"><label for="Musique">Musique</label></div><br>
            <div class="option"><input type="checkbox" name="Guerre" data-g="Guerre" id="Guerre"><label  for="Guerre">Guerre</label></div>
            <div class="center option"><input type="checkbox" name="Biographie" data-g="Biographie" id="Biographie"><label for="Biographie">Biographie</label></div><br>
            <div class="option"><input type="checkbox" name="Documentaire" data-g="Documentaire" id="Documentaire"><label  for="Documentaire">Documentaire</label></div>
        </div>
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
                <a class="nbPage" href="{{preg_replace(['/^\/*/', BASE_URI.'\/*/', '/page\/(.*)/'], '', $_SERVER['REQUEST_URI']) . 'page/'.$i}}"> {{$i}} </a>
            @else
                <span class="currentPage nbPage">{{$i}}</span>
            @endif
        @endfor
    </div>
</section>

<footer>

</footer>