<h1>Inscription</h1>
<form action="" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="
        @isset($_POST['email'])
            {{$_POST['email']}}
        @endisset
    "><br/>
    <label for="pseudo">Pseudo:</label>
    <input type="text" name="pseudo" id="pseudo" value="
        @isset($_POST['pseudo'])
            {{$_POST['pseudo']}}
        @endisset
    "><br/>
    <label for="nom">Nom:</label>
    <input type="text" name="nom" id="nom" value="
        @isset($_POST['nom'])
            {{$_POST['nom']}}
        @endisset
    "><br/>
    <label for="prenom">Prenom:</label>
    <input type="text" name="prenom" id="prenom" value="
        @isset($_POST['prenom'])
            {{$_POST['prenom']}}
        @endisset
    "><br/>
    <label for="date_naissance">Date de naissance:</label>
    <input type="date" name="date_naissance" id="date_naissance" value="
        @isset($_POST['date_naissance'])
            {{$_POST['date_naissance']}}
        @endisset
    "><br/>
    <label for="sexe">Sexe:</label>
    <select name="sexe" id="sexe"><br/>
        <option value="H">Homme</option>
        <option value="F">Femme</option>
        <option value="A">Autre</option>
    </select><br/>
    <label for="password">Mot de Passe:</label>
    <input type="password" name="password" id="password"><br/>
    <input type="submit" value="Entrer">
    @isset($error)
        <p style="color:red; font-weight: 600;">{{$error}}</p>
    @endisset
    @isset($created)
        <p>Votre compte a bien été crée, vous pouvez vous connecter dès maintenant en cliquant <a href="login">ici</a> !</p>
    @endisset
</form>