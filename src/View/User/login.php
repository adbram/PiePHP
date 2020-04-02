<h1>Connexion</h1>
<form action="" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="
        @isset($_POST['email'])
            {{$_POST['email']}}
        @endisset
    "><br/>
    <label for="password">Mot de Passe:</label>
    <input type="password" name="password" id="password"><br/>
    <input type="submit" value="Entrer">
    @isset($error)
        <p style="color:red; font-weight: 600;">{{$error}}</p>
    @endisset
</form>