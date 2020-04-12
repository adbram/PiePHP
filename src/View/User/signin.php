<header class="row">
    <h1 class="col-12">MyCinema</h1>
</header>
<section class="row">
    @isset($created)
        <p class="col-12 created">Votre compte a bien été crée, vous pouvez vous connecter dès maintenant en cliquant <a href="login">ici</a> !</p>
    @endisset
    <h1 class="col-12 offset-md-3 col-md-6 offset-md-3">Inscription</h1>
    <form action="" method="post" id="formSignin" class="col-12">
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" placeholder="Email" type="email" name="email" id="email"
            @isset($_POST['email'])
                value="{{$_POST['email']}}"
            @endisset
        >
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" placeholder="Pseudo" type="text" name="pseudo" id="pseudo"
            @isset($_POST['pseudo'])
                value="{{$_POST['pseudo']}}"
            @endisset
        >
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" placeholder="Nom" type="text" name="nom" id="nom"
            @isset($_POST['nom'])
                value="{{$_POST['nom']}}"
            @endisset
        >
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" placeholder="Prenom" type="text" name="prenom" id="prenom"
            @isset($_POST['prenom'])
                value="{{$_POST['prenom']}}"
            @endisset
        >
        <div class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4">
            <label for="date_naissance">Age:</label>
            <input type="date" name="date_naissance" id="date_naissance"
                @isset($_POST['date_naissance'])
                    value="{{$_POST['date_naissance']}}"
                @endisset
            >
        </div>
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" placeholder="Mot de passe" type="password" name="password" id="password">
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" type="submit" value="Entrer">
        @isset($error)
            <p class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" style="color:red; font-weight: 600;">{{$error}}</p>
        @endisset
    </form>
    <p class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4">Déjà membre ? Cliquez <a href="login">ici</a></p>
</section>