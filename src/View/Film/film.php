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
    @isset($error)
        <p class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" style="color:red; font-weight: 600;">{{$error}}</p>
    @endisset
    <button data-id="{{$film->id}}" id="editF" class="col-2 col-md-1">Editer</button>
    <h1 class="col-6 col-md-9 titre">{{$film->titre}}</h1>
    <button data-id="{{$film->id}}" id="delete" class="col-2 col-md-1">Supprimer</button>
    <form action="" method="post" id="deleteDiv" class="col-12 offset-md-6 col-md-6 row">
        <input type="hidden" id='id' name="id" value="{{$film->id}}">
        <input placeholder="Mot de passe svp" class="col-8" type="password" name="password" id="password">
        <input class="col-2" type="submit" value="Entrer">
    </form>
    @if($film->poster == NULL)
        <img class="col-6 col-md-3" src="webroot/assets/noImage.png">
    @else
        <img class="col-6 col-md-3" src="data:image/png;base64, {{$film->poster}}" width=150>
    @endif
    <div class="col-6">
        <p class="infos">Genre: <span>{{$film->genre->nom}}</span></p>
        <p class="infos">Annee: <span>{{$film->annee}}</span></p>
        <p class="infos">Duree: <span>{{$film->duree_mins}} mins</span></p>
        <p class="infos">Resume: <span>{{$film->resume}}</span></p>
    </div>
</section>