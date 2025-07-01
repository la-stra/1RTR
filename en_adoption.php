<?php
$pageTitle = 'En adoption';
include_once 'includes/db_connect.php';
include_once 'includes/header.php';

// Récupérer toutes les races uniques pour le filtre
try {
    $stmt_races = $pdo->query("SELECT DISTINCT race FROM chiens ORDER BY race ASC");
    $races = $stmt_races->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    $races = [];
    error_log("Erreur de chargement des races: " . $e->getMessage());
}

// Récupérer tous les chiens pour l'affichage
try {
    $stmt_chiens = $pdo->query("SELECT nom, age, race, photo_url FROM chiens ORDER BY nom ASC");
    $all_dogs = $stmt_chiens->fetchAll();
} catch (PDOException $e) {
    $all_dogs = [];
    error_log("Erreur de chargement des chiens: " . $e->getMessage());
}
?>

<div class="container">
    <section>
        <h2>Chiens en adoption</h2>

        <div class="filters">
            <label for="breedFilter">Filtrer par race :</label>
            <select id="breedFilter">
                <option value="all">Toutes les races</option>
                <?php foreach ($races as $race): ?>
                    <option value="<?php echo htmlspecialchars($race); ?>">
                        <?php echo htmlspecialchars($race); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="dog-grid">
            <?php if (!empty($all_dogs)): ?>
                <?php foreach ($all_dogs as $dog): ?>
                    <div class="card dog-card" data-race="<?php echo htmlspecialchars($dog['race']); ?>">
                        <img src="<?php echo htmlspecialchars($dog['photo_url']); ?>" alt="Photo de <?php echo htmlspecialchars($dog['nom']); ?>">
                        <div class="card-content">
                            <h3><?php echo htmlspecialchars($dog['nom']); ?></h3>
                            <p><strong>Race :</strong> <?php echo htmlspecialchars($dog['race']); ?></p>
                            <p><strong>Âge :</strong> <?php echo htmlspecialchars($dog['age']); ?> ans</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucun chien n'est actuellement disponible à l'adoption.</p>
            <?php endif; ?>
        </div>
    </section>
</div>

<?php
include_once 'includes/footer.php';
?>