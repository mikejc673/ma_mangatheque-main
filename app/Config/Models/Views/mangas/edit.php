<?php
// Pour inclure le contenu de edit.php dans layout.php
$viewPath = __DIR__ . '/edit.php';
// Commence la capture de sortie

// Inclure le modèle Manga
require_once __DIR__ . '/../../Models/Manga.php';

$mangaModel = new Manga();
$manga = $mangaModel->getById($id);
if (!$manga) {
    // Si le manga n'existe pas, rediriger ou afficher un message d'erreur
    echo "Manga non trouvé.";
    exit;
}
?>

<h2>Modifier le Manga : <?= htmlspecialchars($manga['titre']) ?></h2>

<form action="<?= BASE_URL ?>mangas/update/<?= htmlspecialchars($manga['id']) ?>" method="POST">
    <label for="titre">Titre :</label><br>
    <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($manga['titre']) ?>" required><br><br>

    <label for="description">Description :</label><br>
    <textarea id="description" name="description"><?= htmlspecialchars($manga['description']) ?></textarea><br><br>

    <label for="auteurs">Auteurs :</label><br>
    <input type="text" id="auteurs" name="auteurs" value="<?= htmlspecialchars($manga['auteurs']) ?>"><br><br>

    <label for="nb_volumes">Nombre de volumes :</label><br>
    <input type="number" id="nb_volumes" name="nb_volumes" value="<?= htmlspecialchars($manga['nb_volumes']) ?>"><br><br>

    <label for="statut">Statut :</label><br>
    <select id="statut" name="statut">
        <option value="En cours" <?= ($manga['statut'] == 'En cours') ? 'selected' : '' ?>>En cours</option>
        <option value="Terminé" <?= ($manga['statut'] == 'Terminé') ? 'selected' : '' ?>>Terminé</option>
        <option value="Abandonné" <?= ($manga['statut'] == 'Abandonné') ? 'selected' : '' ?>>Abandonné</option>
        <option value="Pause" <?= ($manga['statut'] == 'Pause') ? 'selected' : '' ?>>En Pause</option>
    </select><br><br>

    

    <button type="submit">Mettre à jour le Manga</button>
</form>

<p><a href="<?= BASE_URL ?>mangas/show/<?= htmlspecialchars($manga['id']) ?>">Annuler</a> | <a href="<?= BASE_URL ?>mangas">Retour à la liste</a></p>