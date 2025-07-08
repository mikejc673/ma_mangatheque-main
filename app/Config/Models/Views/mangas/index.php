<?php
// Utilisation du tampon de sortie pour passer le contenu au layout
ob_start();
?>

<h2>Liste des Mangas</h2>

<?php
// Afficher les messages de succès ou d'erreur s'ils existent
if (isset($_SESSION['success_message'])): ?>
    <div style="color: green; border: 1px solid green; padding: 10px; margin-bottom: 10px;">
        <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
        <?= $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
    </div>
<?php endif; ?>

<?php if (empty($mangas)): ?>
    <p>Aucun manga enregistré pour le moment. <a href="<?= BASE_URL ?>mangas/create">Ajoutez-en un !</a></p>
<?php else: ?>
    <ul>
        <?php foreach ($mangas as $manga): ?>
            <li>
                <a href="<?= BASE_URL ?>mangas/show/<?= $manga['id'] ?>">
                    <?= htmlspecialchars($manga['titre']) ?>
                </a>
                (<?= isset($manga['statut']) ? htmlspecialchars($manga['statut']) : 'N/A' ?>)
                <span>
                    <a href="<?= BASE_URL ?>mangas/edit/<?= $manga['id'] ?>">Modifier</a>
                    <form action="<?= BASE_URL ?>mangas/delete/<?= $manga['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce manga ?');">
                        <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">Supprimer</button>
                    </form>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php
$viewContent = ob_get_clean(); // Récupère le contenu et vide le tampon
include __DIR__ . '/../layout.php'; // Inclut le layout avec le contenu
?>