<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popcorn Chaos — Films au Hasard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Permanent+Marker&family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/popcornChaos/public/assets/css/style.css">
</head>
<body>
<!-- Ambient sparks -->
<div class="sparks" aria-hidden="true">
    <div class="spark" style="left:8%;  height:80px;  background:var(--orange); animation-delay:0s;    animation-duration:3.8s;"></div>
    <div class="spark" style="left:22%; height:50px;  background:var(--green);  animation-delay:1.2s;  animation-duration:4.5s;"></div>
    <div class="spark" style="left:40%; height:100px; background:var(--yellow); animation-delay:0.5s;  animation-duration:3.2s;"></div>
    <div class="spark" style="left:55%; height:60px;  background:var(--purple); animation-delay:2s;    animation-duration:5s;"></div>
    <div class="spark" style="left:72%; height:90px;  background:var(--red);    animation-delay:0.8s;  animation-duration:4.1s;"></div>
    <div class="spark" style="left:88%; height:55px;  background:var(--green);  animation-delay:1.7s;  animation-duration:3.6s;"></div>
</div>
<?php include '../app/Views/layouts/header.php' ?>

<main>
    <!-- ── CONNEXION ── -->
    <div class="card card-connexion">
        <form action="connection" method="post">
            <fieldset>
                <div class="card-title">Se connecter</div>
                <div class="field">
                    <label for="login_con">Pseudo</label>
                    <input type="text" id="login_con" name="login" placeholder="CinéManiaque42" required>
                </div>
                <div class="field">
                    <label for="password_con">Mot de passe</label>
                    <input type="password" id="password_con" name="password" placeholder="......." required>
                </div>
                <button class="btn btn-chaos" type="submit" name="connection">⚡ Se connecter</button>
            </fieldset>
        </form>
        <p class="msg"><?php echo $messageConnection ?? '' ?></p>
    </div>
    <!-- ── INSCRIPTION ── -->
    <div class="card card-inscription">
        <form action="inscription" method="post">
            <fieldset>
                <div class="card-title">Créer un compte</div>
                <div class="field">
                    <label for="name">Nom</label>
                    <input type="text" id="name" name="name" placeholder="Dupont" required>
                </div>
                <div class="field">
                    <label for="surname">Prénom</label>
                    <input type="text" id="surname" name="surname" placeholder="Jean" required>
                </div>
                <div class="field">
                    <label for="login_reg">Pseudo</label>
                    <input type="text" id="login_reg" name="login" placeholder="CinéManiaque42" required>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="jean@chaos.film" required>
                </div>
                <div class="field">
                    <label for="password_reg">Mot de passe</label>
                    <input type="password" id="password_reg" name="password" placeholder="......." required>
                </div>
                <div class="field">
                    <label for="confirmPassword">Confirmer le mot de passe</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="........" required>
                </div>
                <button class="btn btn-fire" type="submit" name="inscription">🔥 S'inscrire</button>
            </fieldset>
            <p class="msg"><?php echo $messageInscription ?? '' ?></p>
        </form>
    </div>
</main>
<?php include 'footer.php' ?>
</body>
</html>