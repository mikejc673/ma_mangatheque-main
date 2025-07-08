<?php 
// Pour inclure le contenu de create.php dans layout.php
$viewPath = __DIR__ . '/create.php'; 
 // Commence la capture de sortie
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

    <label for="auteur">Auteur :</label><br>
    <input type="text" id="auteur" name="auteur" required><br><br>

    <button type="submit">Ajouter le Manga</button>
</form>

<p><a href="<?= BASE_URL ?>mangas">Retour à la liste des Mangas</a></p>

<?php 
// Récupère le contenu et vide le tampon
include __DIR__ . '/../layout.php'; // Inclut le layout avec le contenu
?>