<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
    </header>
    <main>
        <form action="inscription" method="post">
            <fieldset>
                <legend>Inscription</legend>
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" required>
                <label for="surname">Prénom :</label>
                <input type="text" id="surname" name="surname" required>
                <label for="login">Pseudo :</label>
                <input type="text" id="login" name="login" required>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <label for="confirmPassword">Confirmer le mot de passe :</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <button type="submit" name="inscription">S'inscrire</button>
            </fieldset>
            <p><?php echo $messageInscription ?></p>
        </form>
        <form action="connection" method="post">
            <fieldset>
                <legend>Connexion</legend>
                <label for="login">Nom d'utilisateur :</label>
                <input type="text" id="login" name="login" required>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                </label>
                <button type="submit" name=""connection>Se connecter</button>
            </fieldset>
        </form>
    </main>
    <footer>

    </footer>
</body>
</html>