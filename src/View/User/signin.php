<h1>Inscription</h1>
<form action="addaccount" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email"><br/>
    <label for="pseudo">Pseudo:</label>
    <input type="text" name="pseudo" id="pseudo"><br/>
    <label for="nom">Nom:</label>
    <input type="text" name="nom" id="nom"><br/>
    <label for="prenom">Prenom:</label>
    <input type="text" name="prenom" id="prenom"><br/>
    <label for="date_naissance">Date de naissance:</label>
    <input type="date" name="date_naissance" id="date_naissance"><br/>
    <label for="sexe">Sexe:</label>
    <select name="sexe" id="sexe"><br/>
        <option value="H">Homme</option>
        <option value="F">Femme</option>
        <option value="A">Autre</option>
    </select><br/>
    <label for="password">Password:</label>
    <input type="password" name="password" id="password"><br/>
    <input type="submit" value="Entrer">
</form>