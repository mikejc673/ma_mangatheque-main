<?php
// Pour inclure le contenu de edit.php dans layout.php
$viewPath = __DIR__ . '/edit_content.php';
ob_start(); // Commence la capture de sortie
?>

<h2>Modifier le Manga : <?= htmlspecialchars($manga['titre']) ?></h2>

<form action="<?= BASE_URL ?>mangas/update/<?= htmlspecialchars($manga['id']) ?>" method="POST">
    <label for="titre">Titre :</label><br>
    <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($manga['titre']) ?>" required><br><br>

    <label for="description">Description :</label><br>
    <textarea id="description" name="description"><?= htmlspecialchars($manga['description']) ?></textarea><br><br>

    <label for="nb_volumes">Nombre de volumes :</label><br>
    <input type="number" id="nb_volumes" name="nb_volumes" value="<?= htmlspecialchars($manga['nb_volumes']) ?>"><br><br>

    <label for="statut">Statut :</label><br>
    <select id="statut" name="statut">
        <option value="En cours" <?= ($manga['statut'] == 'En cours') ? 'selected' : '' ?>>En cours</option>
        <option value="Terminé" <?= ($manga['statut'] == 'Terminé') ? 'selected' : '' ?>>Terminé</option>
        <option value="Abandonné" <?= ($manga['statut'] == 'Abandonné') ? 'selected' : '' ?>>Abandonné</option>
        <option value="Pause" <?= ($manga['statut'] == 'Pause') ? 'selected' : '' ?>>En Pause</option>
    </select><br><br>

    <label for="image_couverture">URL de l'image de couverture :</label><br>
    <input type="text" id="image_couverture" name="image_couverture" value="<?= htmlspecialchars($manga['image_couverture']) ?>"><br><br>

    <label for="note_personnelle">Note personnelle (1-10) :</label><br>
    <input type="number" id="note_personnelle" name="note_personnelle" min="1" max="10" value="<?= htmlspecialchars($manga['note_personnelle']) ?>"><br><br>

    <button type="submit">Mettre à jour le Manga</button>
</form>

<p><a href="<?= BASE_URL ?>mangas/show/<?= htmlspecialchars($manga['id']) ?>">Annuler</a> | <a href="<?= BASE_URL ?>mangas">Retour à la liste</a></p>

<?php
$viewContent = ob_get_clean(); // Récupère le contenu et vide le tampon
include __DIR__ . '/../layout.php'; // Inclut le layout avec le contenu
?>