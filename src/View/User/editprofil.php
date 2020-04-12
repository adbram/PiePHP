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
    <h1>Modifiez vos infos</h1>
    <form action="" method="post" id="formEdit" class="col-12">
        <input type="hidden" name="email" value="{{$user->email}}">
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" placeholder="Pseudo" type="text" name="pseudo" id="pseudo" value="{{$user->pseudo}}">
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" placeholder="Nom" type="text" name="nom" id="nom" value="{{$user->nom}}">
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" placeholder="Prenom" type="text" name="prenom" id="prenom" value="{{$user->prenom}}">
        <div class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4">
            <label for="date_naissance">Age:</label>
            <input type="date" name="date_naissance" id="date_naissance" value="{{$user->date_naissance}}">
        </div>
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" placeholder="Nouveau mot de passe" type="password" name="password" id="password">
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" placeholder="Ancien mot de passe" type="password" name="passwordII" id="passwordII">
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" type="submit" value="Entrer">
    </form>
    @isset($error)
            <p class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" style="color:red; font-weight: 600;">{{$error}}</p>
    @endisset
</section>