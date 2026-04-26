<h1>Bienvenu <?php echo $_SESSION['loginUser'] ?></h1>
<p>Nom : <?php echo $_SESSION['nameUser'] ?></p>
<p>Prénom : <?php echo $_SESSION['surnameUser'] ?></p>
<p> Mail : <?php echo $_SESSION['emailUser'] ?></p>

<fieldset><legend>Créer un groupe</legend>User
    <form method="post">
        <label for="name">Nom du groupe</label>
        <input type="text" id="name" name="nameGroup" required>
        <button class="btn btn-group" type="submit" name="create_group">Créer</button>
    </form>
    <p><?php echo $messagecreationGroup  ?></p>
</fieldset>

<fieldset><legend>Afficher le code d'accès à un groupe</legend>
    <form method="post">
        <div id="modal-edit" class="modal <?= isset($_POST['getCode']) ? 'active' : '' ?>">
            <div class="modal-content">
                <h1>CODE : </h1>
                <h2><?php echo $messageCode ?? '' ?><br></h2>
                <a href="profil" class="close-btn">Fermer</a>            
                
            </div>
        </div>
        <select name="idGroup">
            <option value="">-- Choisir un groupe --</option>
            <?php foreach ($groups as $group): ?>
                <option value="<?= $group->getIdGroup() ?>">
                    <?= $group->getNameGroup() ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="getCode">Afficher</button>
    </form>
</fieldset>

<fieldset><legend>Ajouter un film</legend>
    <form method="post">
        <label for="groupe">Groupes</label>
        <select name="idGroup">
            <option value="">-- Choisir un groupe --</option>
            <?php foreach ($groups as $group): ?>
                <option value="<?= $group->getIdGroup() ?>">
                    <?= $group->getNameGroup() ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="film">Film</label>
        <input type="text" id="film" name="nameFilm">
        <button type="submit" name="sendFilm">Enregistrer</button>
    </form>
</fieldset>