<?php

session_start(); // Ajoutez cette ligne au tout début

// Fichier d'entrée unique de l'application
// C'est ici que toutes les requêtes seront traitées.

// 1. Charger les fichiers de configuration
require_once __DIR__ . '/../app/Config/config.php';

// 2. Charger les autoloads des classes (on va le faire manuellement pour l'instant, puis on utilisera Composer)
require_once __DIR__ . '/../app/Config/Models/Database.php';
require_once __DIR__ . '/../app/Config/Models/Manga.php';
require_once __DIR__ . '/../app/Config/Models/Controller/MangaController.php';

// 3. Simple système de routage (à améliorer par la suite)
// On va déterminer quelle action l'utilisateur veut faire en fonction de l'URL
$requestUri = trim($_SERVER['REQUEST_URI'], '/');
$segments = explode('/', $requestUri);

// On ignore le premier segment s'il s'agit du dossier racine (ex: /ma_mangatheque)
if (isset($segments[0]) && $segments[0] === 'ma_mangatheque-main') { // Adaptez ceci si votre projet n'est pas dans un sous-dossier
    array_shift($segments);
}
// On ignore aussi le segment 'index.php' si présent
if (isset($segments[0]) && strtolower($segments[0]) === 'index.php') {
    array_shift($segments);
}

$controllerName = 'MangaController'; // Par défaut, MangaController
$actionName = !empty($segments[1]) ? $segments[1] : 'index'; // Par défaut, l'action index

$id = null;
if (isset($segments[2]) && is_numeric($segments[2])) {
    $id = (int) $segments[2];
}

// Pour le moment, nous allons instancier le MangaController directement
// Plus tard, nous pourrons le rendre dynamique.

if ($controllerName === 'MangaController') {
    $controller = new MangaController();
    
    switch ($actionName) {
        case 'index':
            $controller->index();  // GET /mangas
            break;
        case 'create':
            $controller->create(); // GET /mangas/create
            break;
        case 'store':
            $controller->store(); // POST /mangas/store
            break;
        case 'show':
            if ($id !== null) {
                $controller->show($id); // GET /mangas/[i:id]
            } else {
                // Gérer l'erreur si l'ID est manquant
                echo "Erreur : ID de manga manquant pour l'affichage.";
            }
            break;
        case 'edit':
            if ($id !== null) {
                $controller->edit($id); // GET /mangas/[i:id]/edit
            } else {
                echo "Erreur : ID de manga manquant pour l'édition.";
            }
            break;
        case 'update':
            if ($id !== null) {
                $controller->update($id); // POST /mangas/[i:id]/update
            } else {
                echo "Erreur : ID de manga manquant pour la mise à jour.";
            }
            break;
        case 'delete':
            if ($id !== null) {
                $controller->delete($id); // POST /mangas/[i:id]/delete
            } else {
                echo "Erreur : ID de manga manquant pour la suppression.";
            }
            break;
        default:
            // Gérer les routes non trouvées (erreur 404)
            echo "Page non trouvée !";
            break;
    }
} else {
    echo "Contrôleur non trouvé !";
}

?>