const panels = ['create', 'code', 'join', 'film', 'hat'];
const titles = {
    create: ['Créer un groupe',    'Nouveau groupe de cinéphiles'],
    code:   ['Code d\'accès',      'Partage l\'accès à ton groupe'],
    join:   ['Rejoindre',          'Entre dans un groupe existant'],
    film:   ['Ajouter un film',    'Alimente la liste de ton groupe'],
    hat:    ['Tirer au chapeau',   'Laisse le hasard décider'],
};

function showPanel(name, btn) {
    document.getElementById('panel-welcome').style.display = 'none';
    panels.forEach(p => {
        const el = document.getElementById('panel-' + p);
        if (el) el.classList.remove('active');
    });
    document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));

    const target = document.getElementById('panel-' + name);
    if (target) {
        target.classList.add('active');
        void target.offsetWidth; // force reflow pour relancer l'animation
    }
    if (btn) btn.classList.add('active');

    if (titles[name]) {
        document.getElementById('topbar-title').textContent   = titles[name][0];
        document.getElementById('topbar-subtitle').textContent = titles[name][1];
    }
}

function closeModal(e) {
    document.getElementById('modal-code').classList.remove('active');     
}




