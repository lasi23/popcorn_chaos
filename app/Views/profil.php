<h1>Bienvenu <?php echo $_SESSION['login'] ?></h1>
<p>Nom : <?php echo $_SESSION['name'] ?></p>
<p>Prénom : <?php echo $_SESSION['surname'] ?></p>
<p> Mail : <?php echo $_SESSION['email'] ?></p>

<fieldset><legend>Créer un groupe</legend>
    <form method="post">
        <label for="name">Nom du groupe</label>
        <input type="text" id="name" name="name" required>
        <button class="btn btn-group" type="submit" name="create_group">Créer</button>
    </form>
    <p><?php echo $messagecreationGroup  ?></p>
</fieldset>

<fieldset><legend>Ajouter un film</legend>
    <form method="post">
        <label for="groupe">Groupes</label>
        <select name="groupe" id="groupe">
            <option value="">-- Choisir un groupe --</option>
            <?php foreach ($groups as $group): ?>
                <option value="<?= htmlspecialchars($group->getId()) ?>">
                    <?= htmlspecialchars($group->getName()) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</fieldset>