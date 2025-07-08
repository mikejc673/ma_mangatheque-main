<?php 
// Pour inclure le contenu de create.php dans layout.php
$viewPath = __DIR__ . '/create_content.php'; 
ob_start(); // Commence la capture de sortie
?>

<h2>Ajouter un nouveau Manga</h2>

<form action="<?= BASE_URL ?>mangas/store" method="POST">
    <label for="titre">Titre :</label><br>
    <input type="text" id="titre" name="titre" required><br><br>

    <label for="description">Description :</label><br>
    <textarea id="description" name="description"></textarea><br><br>

    <label for="nb_volumes">Nombre de volumes :</label><br>
    <input type="number" id="nb_volumes" name="nb_volumes" value="0"><br><br>

    <label for="statut">Statut :</label><br>
    <select id="statut" name="statut">
        <option value="En cours">En cours</option>
        <option value="Terminé">Terminé</option>
        <option value="Abandonné">Abandonné</option>
        <option value="Pause">En Pause</option>
    </select><br><br>

    <label for="image_couverture">URL de l'image de couverture :</label><br>
    <input type="text" id="image_couverture" name="image_couverture"><br><br>

    <label for="note_personnelle">Note personnelle (1-10) :</label><br>
    <input type="number" id="note_personnelle" name="note_personnelle" min="1" max="10"><br><br>

    <button type="submit">Ajouter le Manga</button>
</form>

<p><a href="<?= BASE_URL ?>mangas">Retour à la liste des Mangas</a></p>

<?php 
$viewContent = ob_get_clean(); // Récupère le contenu et vide le tampon
include __DIR__ . '/../layout.php'; // Inclut le layout avec le contenu
?>