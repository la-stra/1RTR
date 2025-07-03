<?php
$pageTitle = 'Accueil';
include_once 'includes/db_connect.php'; // Inclure la connexion à la BDD pour le carrousel
include_once 'includes/header.php';

// Récupérer 5 chiens aléatoires pour le carrousel
try {
    $stmt = $pdo->query("SELECT nom, photo_url FROM chiens ORDER BY RAND() LIMIT 5");
    $carousel_dogs = $stmt->fetchAll();
} catch (PDOException $e) {
    $carousel_dogs = []; // En cas d'erreur, le carrousel sera vide
    error_log("Erreur de chargement des chiens pour le carrousel: " . $e->getMessage());
}
?>

<div class="container">
    <section>
        <h2>Bienvenue à AdopteUnChien !</h2>
        <p class="intro-text">
            AdopteUnChien est une association dédiée à la protection et à l'adoption de chiens abandonnés.
            Notre mission est de donner une seconde chance à ces fidèles compagnons en les aidant à trouver
            des foyers aimants et responsables. Nous croyons que chaque chien mérite une famille.
        </p>
        <p class="intro-text">
            Explorez notre site pour découvrir les chiens disponibles à l'adoption, en apprendre plus sur
            nos services de protection, et comment vous pouvez nous aider.
        </p>
    </section>

    <section>
        <h2>Où nous trouver ?</h2>
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.991666699105!2d2.292292615674395!3d48.85837007928747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e296238b90b%3A0x6e3d2f95c5b4e7a!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1678901234567!5m2!1sfr!2sfr"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <p>Notre local est situé près de la Tour Eiffel à Paris. Venez nous rendre visite !</p>
        </div>
    </section>

    <section>
        <h2>Nos protégés à adopter</h2>
        <div class="carousel">
            <?php if (!empty($carousel_dogs)): ?>
                <?php foreach ($carousel_dogs as $dog): ?>
                    <div class="carousel-item">
                        <img src="<?php echo htmlspecialchars($dog['img']); ?>" alt="Photo de <?php echo htmlspecialchars($dog['nom']); ?>">
                        <h3><?php echo htmlspecialchars($dog['nom']); ?></h3>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun chien disponible pour le carrousel pour le moment.</p>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php
include_once 'includes/footer.php';
?>