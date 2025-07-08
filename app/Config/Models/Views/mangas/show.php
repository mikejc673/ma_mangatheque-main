<?php 
// Pour inclure le contenu de show.php dans layout.php
$viewPath = __DIR__ . '/show_content.php'; 
 // Commence la capture de sortie
?>

<h2>Fiche détaillée : <?= htmlspecialchars($manga['titre']) ?></h2>

<?php if (isset($manga)): ?>
    <p><strong>ID :</strong> <?= htmlspecialchars($manga['id']) ?></p>
    <p><strong>Titre :</strong> <?= htmlspecialchars($manga['titre']) ?></p>
    <p><strong>Auteurs :</strong> <?= htmlspecialchars($manga['auteurs']) ?></p>
    <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($manga['description'])) ?></p>
    <p><strong>Volumes :</strong> <?= htmlspecialchars($manga['nb_volumes']) ?></p>
    <p><strong>Statut :</strong> <?= htmlspecialchars($manga['statut']) ?></p>
    

    <p>
        <a href="<?= BASE_URL ?>mangas/edit/<?= $manga['id'] ?>">Modifier ce manga</a> |
        <a href="<?= BASE_URL ?>mangas">Retour à la liste</a>
    </p>
<?php else: ?>
    <p>Manga non trouvé.</p>
<?php endif; ?>

<?php 
 // Récupère le contenu et vide le tampon
include __DIR__ . '/../layout.php'; // Inclut le layout avec le contenu
?>