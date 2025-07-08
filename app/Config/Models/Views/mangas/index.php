<?php $viewPath = __DIR__ . '/index_content.php'; ?>
<?php include __DIR__ . '/../layout.php'; ?>

<?php ob_start(); ?>
<h2>Liste des Mangas</h2>

<?php if (empty($mangas)): ?>
    <p>Aucun manga enregistré pour le moment. <a href="<?= BASE_URL ?>mangas/create">Ajoutez-en un !</a></p>
<?php else: ?>
    <ul>
        <?php foreach ($mangas as $manga): ?>
            <li>
                <a href="<?= BASE_URL ?>mangas/show/<?= $manga['id'] ?>">
                    <?= htmlspecialchars($manga['titre']) ?>
                </a>
                (<?= htmlspecialchars($manga['statut']) ?>)
                <a href="<?= BASE_URL ?>mangas/edit/<?= $manga['id'] ?>">Modifier</a>
                </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php $index_content = ob_get_clean(); ?>

<?php
// Utiliser une variable pour passer le contenu à layout.php
$viewPath = __DIR__ . '/index_content.php';
// Et ici, on définit le contenu réel de la vue à afficher
$viewContent = $index_content; 
?>

<?php function render_index_content($mangas) { ?>
    <?php } ?>

<?php 
// Pour inclure le contenu de index_content.php dans layout.php
// On utilise une petite astuce pour passer le contenu.
// Dans un vrai framework, ceci serait géré par un moteur de template.
$viewPath = __DIR__ . '/index_content.php'; 
ob_start(); // Commence la capture de sortie
?>

<h2>Liste des Mangas</h2>

<?php if (empty($mangas)): ?>
    <p>Aucun manga enregistré pour le moment. <a href="<?= BASE_URL ?>mangas/create">Ajoutez-en un !</a></p>
<?php else: ?>
    <ul>
        <?php foreach ($mangas as $manga): ?>
            <li>
                <a href="<?= BASE_URL ?>mangas/show/<?= $manga['id'] ?>">
                    <?= htmlspecialchars($manga['titre']) ?>
                </a>
                (<?= htmlspecialchars($manga['statut']) ?>)
                <a href="<?= BASE_URL ?>mangas/edit/<?= $manga['id'] ?>">Modifier</a>
                </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php 
$viewContent = ob_get_clean(); // Récupère le contenu et vide le tampon
include __DIR__ . '/../layout.php'; // Inclut le layout avec le contenu
?>