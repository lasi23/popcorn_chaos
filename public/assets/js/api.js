let timer = null;

// ==========================================
// GESTION DE LA SAISIE AU CLAVIER
// ==========================================
document.getElementById('nameFilm').addEventListener('input', function() {
    const query = this.value;
    
    document.getElementById('idFilmTMDB').value = "";

    clearTimeout(timer);

    if (query.length < 2) {
        document.getElementById('suggestions').innerHTML = '';
        return;
    }

    // Temporisation de 400ms
    timer = setTimeout(() => {
        fetch('/popcornChaos/public/api/search?q=' + encodeURIComponent(query))
            .then(r => r.json())
            .then(data => afficherSuggestions(data.results))
            .catch(err => console.error("Erreur autocomplétion :", err));
    }, 400);
});

// ==========================================
// AFFICHAGE DES SUGGESTIONS
// ==========================================
function afficherSuggestions(films) {
    const ul = document.getElementById('suggestions');
    ul.innerHTML = '';

    if (!films || films.length === 0) return;

    films.slice(0, 8).forEach(film => {
        const li = document.createElement('li');
        li.textContent = film.title + ' (' + film.release_date?.slice(0,4) + ')';
        
        li.onclick = () => selectionnerFilm(film);
        ul.appendChild(li);
    });
}

// ==========================================
// SÉLECTION D'UN FILM DANS LA LISTE
// ==========================================
function selectionnerFilm(film) {
    console.log('Film sélectionné :', film);
    
    document.getElementById('nameFilm').value = film.title;
    document.getElementById('idFilmTMDB').value = film.id; // L'id secret est stocké !
    document.getElementById('suggestions').innerHTML = '';
}

// ==========================================
// VERROUILLAGE ET SÉCURITÉ DU SUBMIT
// ==========================================
document.getElementById('formFilm').addEventListener('submit', function(e) {
    const idFilm = document.getElementById('idFilmTMDB').value;
    const nomSaisi = document.getElementById('nameFilm').value.trim();

    // Si le champ caché est vide (aucun film sélectionné dans la liste TMDB)
    if (idFilm === "") {
        
        if (nomSaisi.length > 4) {
            // On ouvre le prompt de vérification active
            const verification = prompt(
                "Le film \"" + nomSaisi + "\" n'a pas été trouvé.\n\n" +
                "Si vous êtes SUR de l'orthographe et que vous voulez FORCER l'enregistrement, " +
                "tapez de nouveau votre film ci-dessous puis validez :"
            );

            // ÉTAPE 1 : Si l'utilisateur clique sur Annuler (ou ferme la fenêtre)
            if (verification === null) {
                e.preventDefault(); // On bloque l'envoi
                return;
            }

            // On nettoie les espaces de la deuxième saisie
            const nomVerif = verification.trim();

            // ÉTAPE 2 : On compare STRICTEMENT les deux chaînes (lettre par lettre)
            // On utilise .toLowerCase() pour valider même si les majuscules diffèrent légèrement
            if (nomVerif.toLowerCase() !== nomSaisi.toLowerCase()) {
                e.preventDefault(); // Les titres ne correspondent pas, on bloque tout !
                
                alert(
                    "Validation incorrecte !\n\n" +
                    "Vous avez tapé : \"" + nomVerif + "\"\n" +
                    "Au lieu de : \"" + nomSaisi + "\"\n\n" +
                    "Le titre réécrit doit être identique pour éviter les doublons."
                );
            } else {
                // ÉTAPE 3 : Succès ! On écrase la valeur du formulaire avec la version nettoyée du prompt
                // Cela garantit une bdd propre et harmonisée (anti-doublon)
                document.getElementById('nameFilm').value = nomVerif;
                console.log("Enregistrement forcé validé. Envoi du formulaire...");
            }

        } else {
            // Si le titre fait moins de 4 caractères et n'est pas lié à TMDB
            e.preventDefault(); 
            alert("Veuillez sélectionner un film dans la liste ou tapez un nom plus précis (plus de 4 caractères).");
        }
    } else {
        // Si idFilm n'est PAS vide, le film vient de l'API TMDB, tout est ok, le formulaire s'envoie normalement !
        console.log("Film TMDB valide détecté. Envoi...");
    }
});