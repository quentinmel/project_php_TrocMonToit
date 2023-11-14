<html>
    <head>
        <title>Inscription</title>
    </head>
    <body>
        <h1>Inscription</h1>
        <form action="/inscription" method="post">
            <label for="lastname">Nom : </label>
            <input type="text" name="lastname" placeholder="Nom" required /><br />
            <label for="firstname">Prénom : </label>
            <input type="text" name="firstname" placeholder="Prénom" required /><br />
            <label for="phone">Téléphone : </label>
            <input type="text" name="phone" placeholder="+33603030303" required /><br />
            <label for="email">Email : </label> 
            <input type="email" name="email" placeholder="Adresse email" required /><br />
            <label for="password">Mot de passe : </label>
            <input type="password" name="password" placeholder="Mot de passe" required /> <br />
            <label for="password_confirm">Confirmer le mot de passe : </label>
            <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" required /><br />
            <input type="submit" value="S'inscrire" />
        </form>
    </body>
</html>