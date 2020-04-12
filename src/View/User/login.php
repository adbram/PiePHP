<header class="row">
    <h1 class="col-12">MyCinema</h1>
</header>
<section class="row">
    <h1 class="col-12 offset-md-3 col-md-6 offset-md-3">Connexion</h1>
    <form action="" method="post" id="logInForm" class="col-12">
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" placeholder="Email" type="email" name="email" id="email" value="
            @isset($_POST['email'])
                {{$_POST['email']}}
            @endisset
        "><br/>
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" placeholder="Mot de passe" type="password" name="password" id="password"><br/>
        <input class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4" type="submit" value="Entrer">
        @isset($error)
            <p style="color:red; font-weight: 600;">{{$error}}</p>
        @endisset
    </form>
    <p class=" offset-2 col-8 offset-2 offset-md-4 col-md-4 offset-md-4">Pas encore de compte ? Cliquez <a href="signin">ici</a></p>
</section>