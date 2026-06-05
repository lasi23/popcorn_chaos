<?php /* profil.php — Dashboard utilisateur */ ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil — Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Bangers&family=Nunito:wght@400;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="profil.css">
</head>
<body>

<div class="dashboard">

  <!-- ── SIDEBAR ── -->
  <aside class="sidebar">
    <div class="profile-block">
      <div class="profile-avatar">
        <?php echo strtoupper(substr($_SESSION['loginUser'] ?? 'U', 0, 2)) ?>
      </div>
      <div class="profile-welcome">Bienvenu</div>
      <div class="profile-name"><?php echo $_SESSION['loginUser'] ?? 'Utilisateur' ?></div>
      <div class="profile-detail">
        <span class="detail-icon">👤</span>
        <span><?php echo ($_SESSION['surnameUser'] ?? '') . ' ' . ($_SESSION['nameUser'] ?? '') ?></span>
      </div>
      <div class="profile-detail">
        <span class="detail-icon">✉️</span>
        <span><?php echo $_SESSION['emailUser'] ?? '' ?></span>
      </div>
    </div>

    <nav class="nav">
      <div class="nav-label">Groupes</div>
      <button class="nav-btn" onclick="showPanel('create', this)">
        <span class="nav-icon">🎬</span> Créer un groupe
      </button>
      <button class="nav-btn" onclick="showPanel('code', this)">
        <span class="nav-icon">🔑</span> Code d'accès
      </button>
      <button class="nav-btn" onclick="showPanel('join', this)">
        <span class="nav-icon">🚪</span> Rejoindre un groupe
      </button>

      <div class="nav-label">Films</div>
      <button class="nav-btn" onclick="showPanel('film', this)">
        <span class="nav-icon">🎥</span> Ajouter un film
      </button>
      <button class="nav-btn" onclick="showPanel('hat', this)">
        <span class="nav-icon">🎩</span> Tirer au chapeau
      </button>

      <form action="?page=logout" method="post">
        <button type="submit" class="btn btn-deconnection">Déconnexion</button>
      </form>
    </nav>
  </aside>

  <!-- ── MAIN CONTENT ── -->
  <div class="main-content">

    <!-- TOP BAR -->
    <div class="topbar">
      <div>
        <div class="topbar-title" id="topbar-title">Tableau de bord</div>
        <div class="topbar-subtitle" id="topbar-subtitle">Sélectionne une action</div>
      </div>
      <div class="topbar-skull">💀</div>
    </div>

    <!-- WELCOME -->
    <div class="panel-welcome" id="panel-welcome">
      <div class="welcome-big">Choisis<br>ton destin</div>
      <div class="welcome-sub">Utilise le menu à gauche pour créer des groupes, ajouter des films ou tirer au sort le prochain film du chapeau.</div>
      <div class="welcome-stats">
        <div class="stat-pill"><strong><?php echo count($groups ?? []) ?></strong> groupes</div>
      </div>
    </div>

    <!-- PANEL: Créer un groupe -->
    <div class="form-panel panel-create" id="panel-create">
      <div class="form-card">
        <div class="form-card-title">Créer un groupe</div>
        <form method="post">
          <div class="field">
            <label for="nameGroup">Nom du groupe</label>
            <input type="text" id="nameGroup" name="nameGroup" placeholder="Ex : Les Cinéphiles" required>
          </div>
          <button class="btn btn-fire" type="submit" name="create_group">🎬 Créer le groupe</button>
        </form>
        <p class="msg"><?php echo $messagecreateGroup ?? '' ?></p>
      </div>
    </div>

    <!-- PANEL: Code d'accès -->
    <div class="form-panel panel-code" id="panel-code">
      <div class="form-card">
        <div class="form-card-title">Code d'accès</div>
        <form method="post">
          <div class="field">
            <label for="idGroupCode">Choisir un groupe</label>
            <select name="idGroup" id="idGroupCode">
              <option value="">-- Choisir un groupe --</option>
              <?php foreach ($groups ?? [] as $group): ?>
                <option value="<?= $group->getIdGroup() ?>"><?= $group->getNameGroup() ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button class="btn btn-chaos" type="submit" name="getCode">🔑 Afficher le code</button>
        </form>
      </div>
    </div>

    <!-- PANEL: Rejoindre un groupe -->
    <div class="form-panel panel-join" id="panel-join">
      <div class="form-card">
        <div class="form-card-title">Rejoindre un groupe</div>
        <form method="post">
          <div class="field">
            <label for="code">Code du groupe</label>
            <input type="text" id="code" name="code" placeholder="Colle le code ici...">
          </div>
          <button class="btn btn-green" type="submit" name="submitSendCode">🚪 Rejoindre</button>
        </form>
      </div>
    </div>

    <!-- PANEL: Ajouter un film -->
    <div class="form-panel panel-film" id="panel-film">
      <div class="form-card">
        <div class="form-card-title">Ajouter un film</div>
        <form method="post" id="formFilm">
          <div class="field">
            <label for="idGroupFilm">Groupe</label>
            <select name="idGroup" id="idGroupFilm">
              <?php foreach ($groups ?? [] as $group): ?>
                <option value="<?= $group->getIdGroup() ?>"><?= $group->getNameGroup() ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="field">
            <label for="nameFilm">Titre du film</label>
            <input type="text" id="nameFilm" name="nameFilm" autocomplete="off">
            <input type="hidden" id="idFilmTMDB" name="idFilmTMDB" value="">              
            <ul id="suggestions"></ul>
          </div>
          <button class="btn btn-fire" type="submit" name="sendFilm">🎥 Enregistrer</button>
        </form>
      </div>
    </div>

    <!-- PANEL: Tirer au chapeau -->
    <div class="form-panel panel-hat" id="panel-hat">
      <div class="form-card">
        <div class="form-card-title">Tirer au chapeau</div>
        <form method="post">
          <div class="field">
            <label for="idGroupHat">Groupe</label>
            <select name="idGroup" id="idGroupHat">
              <?php foreach ($groups ?? [] as $group): ?>
                <option value="<?= $group->getIdGroup() ?>"><?= $group->getNameGroup() ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <button class="btn btn-gold" type="submit" name="submitTakeAHate">🎩 Sort ton film du chapeau</button>
        </form>
        <?php if (!empty($film)): ?>
          <div class="hat-result show">
            <div class="hat-result-label">Le film du soir c'est…</div>
            <div class="hat-result-film">🎬 <?= htmlspecialchars($film['nameFilm']) ?></div>
          </div>
        <?php endif; ?>
      </div>
    </div>

  </div><!-- /main-content -->
</div><!-- /dashboard -->

<!-- ── MODAL CODE D'ACCÈS ── -->
<div class="modal-overlay <?= isset($_POST['getCode']) ? 'active' : '' ?>" id="modal-code" onclick="closeModal(event)">
  <div class="modal-box" onclick="event.stopPropagation()">
    <div class="modal-label">Code d'accès du groupe</div>
    <div class="modal-code"><?php echo $messageCode ?? '—' ?></div>
    <a href="profil" class="modal-close">Fermer</a>
  </div>
</div>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($_POST['create_group'])): ?>
            showPanel('create', document.querySelector('[onclick*="create"]'));
        <?php endif; ?>
        <?php if (isset($_POST['getCode'])): ?>
            showPanel('code', document.querySelector('[onclick*="code"]'));
        <?php endif; ?>
        <?php if (isset($_POST['sendFilm'])): ?>
            showPanel('film', document.querySelector('[onclick*="film"]'));
        <?php endif; ?>
        <?php if (isset($_POST['submitSendCode'])): ?>
            showPanel('join', document.querySelector('[onclick*="join"]'));
        <?php endif; ?>
        <?php if (isset($_POST['submitTakeAHate']) || !empty($_SESSION['film'])): ?>
            showPanel('hat', document.querySelector('[onclick*="hat"]'));
        <?php endif; ?>
    });
</script>
</html>