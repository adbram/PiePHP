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
    <form action="" method="post" id="formEdit" class="col-12">
        <input type="hidden" name="id" value="{{$film->id}}">
        <label class=" col-12 col-md-7" for="titre">Titre</label>
        <input class=" col-12 col-md-7" type="text" name="titre" id="titre" value="{{$film->titre}}">
        <label class=" col-12 col-md-7" for="duree_mins">Duree mins</label>
        <input class=" col-12 col-md-7" type="text" name="duree_mins" id="duree_mins" value="{{$film->duree_mins}}">
        <label class=" col-12 col-md-7" for="resume">Resume</label>
        <textarea class=" col-12 col-md-7" type="text" name="resume" id="resume">{{$film->resume}}</textarea>
        <label class=" col-12 col-md-7" for="genre_id">Genre</label>
        <select name="genre_id" id="genre_id" class=" col-12 col-md-7">
            <option value="{{$genres[intval($film->genre_id) - 1]->id}}">{{$genres[intval($film->genre_id) - 1]->nom}}</option>
            @foreach($genres as $ket => $genre)
                <option value="{{$genre->id}}">{{$genre->nom}}</option>
            @endforeach
        </select>
        <label class=" col-12 col-md-7" for="annee_prod">Annee de production</label>
        <select name="annee" id="annee_prod" class=" col-12 col-md-7">
            <option value="{{$film->annee}}">{{$film->annee}}</option>
            @for($i=intval(date('Y')); $i >= 1950; $i--)
                <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
        <input class=" col-12 col-md-7" type="submit" value="Entrer">
    </form>
    @isset($error)
            <p class=" col-12 col-md-7" style="color:red; font-weight: 600;">{{$error}}</p>
    @endisset
</section>