<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Mangathèque</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body>
    <header>
        <h1>Ma Mangathèque</h1>
        <nav>
            <ul>
                <li><a href="<?= BASE_URL ?>mangas">Liste des Mangas</a></li>
                <li><a href="<?= BASE_URL ?>mangas/create">Ajouter un Manga</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php include $viewPath; // Variable qui sera définie dans les contrôleurs pour inclure la vue spécifique ?>
        <div id="message"></div>
        <script>
            // Exemple de message dynamique
            document.getElementById('message').innerText = "Bienvenue dans votre Mangathèque !";
        </script>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> Ma Mangathèque</p>
    </footer>
</body>
</html>