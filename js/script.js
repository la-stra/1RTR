document.addEventListener('DOMContentLoaded', () => {
    // Fonctionnalité Dark Mode
    const darkModeToggle = document.getElementById('darkModeToggle');
    const body = document.body;

    // Vérifier le mode sauvegardé dans le localStorage au chargement
    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
        darkModeToggle.textContent = 'Mode Jour';
    } else {
        body.classList.remove('dark-mode');
        darkModeToggle.textContent = 'Mode Nuit';
    }

    darkModeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('theme', 'dark');
            darkModeToggle.textContent = 'Mode Jour';
        } else {
            localStorage.setItem('theme', 'light');
            darkModeToggle.textContent = 'Mode Nuit';
        }
    });

    // Fonctionnalité de filtrage des chiens par race (uniquement sur la page en_adoption.php)
    const breedFilter = document.getElementById('breedFilter');
    if (breedFilter) { // S'assurer que l'élément existe sur la page actuelle
        breedFilter.addEventListener('change', () => {
            const selectedRace = breedFilter.value;
            const dogCards = document.querySelectorAll('.dog-card'); // Assurez-vous que vos cartes ont cette classe

            dogCards.forEach(card => {
                const dogRace = card.dataset.race; // Assurez-vous d'avoir data-race="[Nom de la race]" sur chaque carte
                if (selectedRace === 'all' || dogRace === selectedRace) {
                    card.style.display = 'block'; // Afficher la carte
                } else {
                    card.style.display = 'none'; // Cacher la carte
                }
            });
        });
    }

    // Gestion du carrousel (Exemple simple de défilement automatique/manuel si on le souhaite)
    // Pour un carrousel plus avancé, une bibliothèque JS dédiée serait recommandée.
    // Ici, nous nous basons sur le scroll CSS.
});