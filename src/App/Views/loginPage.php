<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="/public/css/style.css">
    <title>Se Connecter</title>
</head>
<body>
<h1>Se Connecter</h1>
        <form action="/loginfinish" method="post">
            <label for="email">Email : </label> 
            <input type="email" name="email" placeholder="Adresse email" required /><br /><br />
            <label for="password">Mot de passe : </label>
            <input type="password" name="password" placeholder="Mot de passe" required /> <br /><br />
            <input type="submit" value="S'inscrire" />
        </form>
</body>
</html>