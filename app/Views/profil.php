<h1>Bienvenu <?php echo $_SESSION['login'] ?></h1>
<p><?php echo $_SESSION['login'] ?></p>
<p><?php echo $_SESSION['name'] ?></p>
<p><?php echo $_SESSION['surname'] ?></p>
<p><?php echo $_SESSION['email'] ?></p>

<fieldset><legend>Créer un groupe</legend>
    <form action="create_group">
        <label for="group_name">Nom du groupe</label>
        <input type="text" id="group_name" name="group_name" required>
        <button class="btn btn-group" action="submit" name="createGroup">Créer</button>
    </form>
</fieldset>
