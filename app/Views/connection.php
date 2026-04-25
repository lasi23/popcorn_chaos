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
                    <input type="password" id="password_con" name="password" autocomplete="off" placeholder="......." required>
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
                    <input type="text" id="name" name="nameUser" placeholder="Dupont" required>
                </div>
                <div class="field">
                    <label for="surname">Prénom</label>
                    <input type="text" id="surname" name="surnameUser" placeholder="Jean" required>
                </div>
                <div class="field">
                    <label for="login_reg">Pseudo</label>
                    <input type="text" id="login_reg" name="loginUser" placeholder="CinéManiaque42" required>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="emailUser" placeholder="jean@chaos.film" required>
                </div>
                <div class="field">
                    <label for="password_reg">Mot de passe</label>
                    <input type="password" id="password_reg" name="passwordUser" autocomplete="new-password" placeholder="......." required>
                </div>
                <div class="field">
                    <label for="confirmPassword">Confirmer le mot de passe</label>
                    <input type="password" id="confirmPassword" name="confirmPasswordUser" autocomplete="new-password" placeholder="........" required>
                </div>
                <button class="btn btn-fire" type="submit" name="inscription">🔥 S'inscrire</button>
            </fieldset>
            <p class="msg"><?php echo $messageInscription ?? '' ?></p>
        </form>
    </div>