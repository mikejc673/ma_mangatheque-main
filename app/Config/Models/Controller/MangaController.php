<?php

class MangaController {
    private $mangaModel;

    public function __construct() {
        $this->mangaModel = new Manga();
    }

    public function index() {
       
        $stmt = $this->mangaModel->getAll();
        $mangas = $stmt->fetchAll(PDO::FETCH_ASSOC);

     
        $viewPath = __DIR__ . '/../Views/mangas/index.php';
       
        ob_start();
        include $viewPath; 
        $viewContent = ob_get_clean();
        include __DIR__ . '/../Views/layout.php'; 
    }

    public function show($id) {
        if ($this->mangaModel->getById($id)) {
            $manga = [
                'id' => $this->mangaModel->id,
                'titre' => $this->mangaModel->titre,
                'description' => $this->mangaModel->description,
                'nb_volumes' => $this->mangaModel->nb_volumes,
                'statut' => $this->mangaModel->statut,
                'auteurs' => $this->mangaModel->auteurs,
            ];
            $viewPath = __DIR__ . '/../Views/mangas/show.php';
            ob_start();
            include $viewPath;
            $viewContent = ob_get_clean();
            include __DIR__ . '/../Views/layout.php';
        } else {
            // Redirection vers une page d'erreur ou la liste avec un message
            $_SESSION['error_message'] = "Le manga demandé n'existe pas.";
            header('Location: ' . BASE_URL . 'mangas');
            exit();
        }
    }

    public function create() {
        // Afficher le formulaire d'ajout
        $viewPath = __DIR__ . '/../Views/mangas/create.php';
        ob_start();
        include $viewPath;
        $viewContent = ob_get_clean();
        include __DIR__ . '/../Views/layout.php';
    }

    public function store() {
        // Vérifier si la méthode de requête est POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assigner les valeurs du formulaire aux propriétés de l'objet Manga
            $this->mangaModel->titre = $_POST['titre'] ?? '';
            $this->mangaModel->description = $_POST['description'] ?? '';
            $this->mangaModel->nb_volumes = $_POST['nb_volumes'] ?? 0;
            $this->mangaModel->statut = $_POST['statut'] ?? 'En cours';
            $this->mangaModel->auteurs = $_POST['auteur'] ?? '';

            // Validation des champs pour respecter la contrainte SQL
            $statuts_valides = ['En cours', 'Terminé', 'Abandonné', 'Pause'];
            if (!in_array($this->mangaModel->statut, $statuts_valides)) {
                $_SESSION['error_message'] = "Statut invalide.";
                header('Location: ' . BASE_URL . 'mangas/create');
                exit();
            }
           

            // Tenter de créer le manga
            if ($this->mangaModel->create()) {
                // Redirection vers la liste des mangas avec un message de succès
                $_SESSION['success_message'] = "Manga ajouté avec succès !";
                header('Location: ' . BASE_URL . 'mangas');
                exit();
            } else {
                // En cas d'échec, rediriger vers le formulaire avec un message d'erreur
                $_SESSION['error_message'] = "Erreur lors de l'ajout du manga.";
                header('Location: ' . BASE_URL . 'mangas/create');
                exit();
            }
        } else {
            // Si ce n'est pas une requête POST, rediriger ou afficher une erreur
            $_SESSION['error_message'] = "Méthode non autorisée.";
            header('Location: ' . BASE_URL . 'mangas/create');
            exit();
        }
    }

    public function edit($id) {
       
        if ($this->mangaModel->getById($id)) {
            $manga = [
                'id' => $this->mangaModel->id,
                'titre' => $this->mangaModel->titre,
                'auteurs' => $this->mangaModel->auteurs,
                'description' => $this->mangaModel->description,
                'nb_volumes' => $this->mangaModel->nb_volumes,
                'statut' => $this->mangaModel->statut,
                
            ];
            $viewPath = __DIR__ . '/../Views/mangas/edit.php';
            ob_start();
            include $viewPath;
            $viewContent = ob_get_clean();
            include __DIR__ . '/../Views/layout.php';
        } else {
            $_SESSION['error_message'] = "Le manga à modifier n'existe pas.";
            header('Location: ' . BASE_URL . 'mangas');
            exit();
        }
    }

    public function update($id) {
        // Vérifier si la méthode de requête est POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assigner l'ID et les nouvelles valeurs du formulaire aux propriétés de l'objet Manga
            $this->mangaModel->id = $id;
            $this->mangaModel->titre = $_POST['titre'] ?? '';
            $this->mangaModel->auteurs = $_POST['auteurs'] ?? '';
            $this->mangaModel->description = $_POST['description'] ?? '';
            $this->mangaModel->nb_volumes = $_POST['nb_volumes'] ?? 0;
            $this->mangaModel->statut = $_POST['statut'] ?? 'En cours';
           

            // Validation des champs pour respecter la contrainte SQL
            $statuts_valides = ['En cours', 'Terminé', 'Abandonné', 'Pause'];
            if (!in_array($this->mangaModel->statut, $statuts_valides)) {
                $_SESSION['error_message'] = "Statut invalide.";
                header('Location: ' . BASE_URL . 'mangas/edit/' . $id);
                exit();
            }
            

            // Tenter de mettre à jour le manga
            if ($this->mangaModel->update()) {
                $_SESSION['success_message'] = "Manga mis à jour avec succès !";
                header('Location: ' . BASE_URL . 'mangas/show/' . $id);
                exit();
            } else {
                $_SESSION['error_message'] = "Erreur lors de la mise à jour du manga.";
                header('Location: ' . BASE_URL . 'mangas/edit/' . $id);
                exit();
            }
        } else {
            $_SESSION['error_message'] = "Méthode non autorisée.";
            header('Location: ' . BASE_URL . 'mangas');
            exit();
        }
    }

    public function delete($id) {
        // Vérifier si la méthode de requête est POST (pour la suppression, c'est une bonne pratique)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assigner l'ID du manga à supprimer
            $this->mangaModel->id = $id;

            // Tenter de supprimer le manga
            if ($this->mangaModel->delete()) {
                $_SESSION['success_message'] = "Manga supprimé avec succès !";
                header('Location: ' . BASE_URL . 'mangas');
                exit();
            } else {
                $_SESSION['error_message'] = "Erreur lors de la suppression du manga.";
                header('Location: ' . BASE_URL . 'mangas');
                exit();
            }
        } else {
            // Si la requête n'est pas POST, rediriger avec une erreur ou afficher une confirmation
            // Pour une suppression, il est recommandé d'utiliser un formulaire POST pour la confirmation.
            $_SESSION['error_message'] = "Méthode non autorisée pour la suppression.";
            header('Location: ' . BASE_URL . 'mangas');
            exit();
        }
    }
}
