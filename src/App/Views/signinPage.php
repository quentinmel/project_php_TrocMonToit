<?php 

require_once("App/Models/injection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_confirmation = $_POST["password_confirm"];
}
?>

<html>
    <head>
        <title>Inscription</title>
        <link rel="stylesheet" href="/public/css/style.css">
    </head>
    <body>
        <h1>Inscription</h1>
        <form action="/signinfinish" method="post">
            <label for="lastname">Nom : </label>
            <input type="text" name="lastname" placeholder="Nom" required /><br /><br />
            <label for="firstname">Prénom : </label>
            <input type="text" name="firstname" placeholder="Prénom" required /><br /><br />
            <label for="phone">Téléphone : </label>
            <input type="text" name="phone" placeholder="+33603030303" required /><br /><br />
            <label for="email">Email : </label> 
            <input type="email" name="email" placeholder="Adresse email" required /><br /><br />
            <label for="password">Mot de passe : </label>
            <input type="password" name="password" placeholder="Mot de passe" required /> <br /><br />
            <label for="password_confirm">Confirmer le mot de passe : </label>
            <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" required /><br /><br />
            <input type="submit" value="S'inscrire" />
        </form>
        <h4>Déjà inscrit ? <a href="/login">Connectez-vous</a></h4>
    </body>
</html>