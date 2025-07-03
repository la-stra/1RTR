<?php
$pageTitle = 'Backoffice - AdopteUnChien';
include_once 'includes/db_connect.php'; // Inclure la connexion à la BDD

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $age = intval($_POST['age'] ?? 0);
    $race = trim($_POST['race'] ?? '');
    $photo = $_FILES['photo'] ?? null;

    // Validation des champs
    if (empty($nom) || $age <= 0 || empty($race) || !isset($photo) || $photo['error'] !== UPLOAD_ERR_OK) {
        $message = 'Tous les champs (Nom, Âge, Race, Photo) sont obligatoires et l\'âge doit être supérieur à 0.';
        $messageType = 'error';
    } else {
        $target_dir = "img/";
        $imageFileType = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));
        $unique_filename = uniqid('dog_') . '.' . $imageFileType;
        $target_file = $target_dir . $unique_filename;
        $uploadOk = 1;

        // Vérifier si le fichier image est une vraie image
        $check = getimagesize($photo["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $message = "Le fichier n'est pas une image.";
            $messageType = 'error';
            $uploadOk = 0;
        }

        // Vérifier la taille du fichier (ex: 5MB max)
        if ($photo["size"] > 5000000) {
            $message = "Désolé, votre fichier est trop volumineux (max 5MB).";
            $messageType = 'error';
            $uploadOk = 0;
        }

        // Autoriser certains formats de fichier
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $message = "Désolé, seuls les formats JPG, JPEG, PNG & GIF sont autorisés.";
            $messageType = 'error';
            $uploadOk = 0;
        }

        // Si tout est ok, essayer d'uploader le fichier
        if ($uploadOk == 1) {
            if (move_uploaded_file($photo["tmp_name"], $target_file)) {
                try {
                    $stmt = $pdo->prepare("INSERT INTO chiens (nom, age, race, photo_url) VALUES (:nom, :age, :race, :photo_url)");
                    $stmt->execute([
                        'nom' => $nom,
                        'age' => $age,
                        'race' => $race,
                        'photo_url' => $target_file
                    ]);
                    $message = 'Chien ajouté avec succès !';
                    $messageType = 'success';
                } catch (PDOException $e) {
                    $message = 'Erreur lors de l\'enregistrement du chien : ' . $e->getMessage();
                    $messageType = 'error';
                    // Supprimer le fichier si l'insertion DB échoue
                    if (file_exists($target_file)) {
                        unlink($target_file);
                    }
                }
            } else {
                $message = "Désolé, une erreur est survenue lors du téléchargement de votre fichier.";
                $messageType = 'error';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="light-mode">
    <header>
        <div class="container header-content">
            <div class="logo">
                <a href="index.php"><img src="img/logo.png" alt="Logo AdopteUnChien"></a>
            </div>
            <button id="darkModeToggle" class="dark-mode-button">Mode Nuit</button>
        </div>
    </header>
    <main>
        <div class="container">
            <section class="backoffice-form">
                <h2>Ajouter un chien à l'adoption</h2>
                <?php if ($message): ?>
                    <div class="message <?php echo $messageType; ?>">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>
                <form action="backoffice.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nom">Nom du chien :</label>
                        <input type="text" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Âge (en années) :</label>
                        <input type="number" id="age" name="age" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="race">Race :</label>
                        <input type="text" id="race" name="race" required>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo du chien :</label>
                        <input type="file" id="photo" name="photo" accept="image/jpeg,image/png,image/gif" required>
                    </div>
                    <button type="submit">Ajouter le chien</button>
                </form>
            </section>
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="footer-content">
                <p>&copy; <?php echo date("Y"); ?> AdopteUnChien. Tous droits réservés.</p>
                <div class="contact-info">
                    <p>Adresse : 123 Rue des Chiens Joyeux, 75001 Paris</p>
                    <p>Email : contact@adopteunchien.fr</p>
                    <p>Téléphone : 01 23 45 67 89</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>