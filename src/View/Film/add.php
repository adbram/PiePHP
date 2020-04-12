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
        <label class=" col-12 col-md-7" for="titre">Titre</label>
        <input class=" col-12 col-md-7" type="text" name="titre" id="titre">
        <label class=" col-12 col-md-7">Duree mins</label>
        <input class=" col-12 col-md-7" type="text" name="duree_mins" id="duree_mins">
        <label class=" col-12 col-md-7" for="resume">Resume</label>
        <textarea class=" col-12 col-md-7" type="text" name="resume" id="resume"></textarea>
        <label class=" col-12 col-md-7" for="genre_id">Genre</label>
        <select name="genre_id" id="genre_id" class=" col-12 col-md-7">
            @foreach($genres as $key => $genre)
                <option value="{{$genre->id}}">{{$genre->nom}}</option>
            @endforeach
        </select>
        <label class=" col-12 col-md-7" for="annee_prod">Annee de production</label>
        <select name="annee" id="annee_prod" class=" col-12 col-md-7">
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