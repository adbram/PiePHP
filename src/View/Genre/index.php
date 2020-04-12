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
    <h1 class="col-12">GENRES</h1>
    @foreach($genres as $ket => $genre)
        <h2 class="col-10">{{ucfirst($genre->nom)}}</h2>
        <button class="col-1 deleteG" data-id="{{$genre->id}}">X</button>
    @endforeach
</section>