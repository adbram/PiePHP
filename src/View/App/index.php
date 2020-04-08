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
    <div class="welcomeDiv col-12">
        <h2>Contribuez au développement de la plus grande banque de films open-source !</h2>
        <p>Inscrivez-vous dès maintenant en cliquant <a href="signin">ici</a>.</p>
    </div>
    @foreach($films as $key => $film)
        <!-- @dif($key < 4) -->
            <div class="movieCard col-6 col-md-3" data-id="{{$film->id}}">
                @if($film->poster == NULL)
                    <img src="webroot/assets/noImage.png">
                @else
                <img src="data:image/png;base64, {{$film->poster}}" width=150>
                @endif
            <h3>{{$film->titre}}</h1>
            </div>
        <!-- @dendif -->
    @endforeach
</section>

<footer>

</footer>