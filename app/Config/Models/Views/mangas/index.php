<?php
// Cette vue ne doit contenir que l'affichage du contenu principal, sans layout ni redéclaration de fonction
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