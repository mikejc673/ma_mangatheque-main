<?php

class MangaController {
    private $mangaModel;

    public function __construct() {
        $this->mangaModel = new Manga();
    }

    public function index() {
        // Récupérer tous les mangas depuis le modèle
        $stmt = $this->mangaModel->getAll();
        $mangas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Inclure la vue pour afficher la liste
        include __DIR__ . '/../Views/mangas/index.php';
    }

    public function show($id) {
        if ($this->mangaModel->getById($id)) {
            $manga = [
                'id' => $this->mangaModel->id,
                'titre' => $this->mangaModel->titre,
                'description' => $this->mangaModel->description,
                'nb_volumes' => $this->mangaModel->nb_volumes,
                'statut' => $this->mangaModel->statut,
                'image_couverture' => $this->mangaModel->image_couverture,
                'note_personnelle' => $this->mangaModel->note_personnelle
            ];
            include __DIR__ . '/../Views/mangas/show.php';
        } else {
            echo "Manga non trouvé."; // Vous pouvez rediriger vers une page 404
        }
    }

    public function create() {
        // Afficher le formulaire d'ajout
        include __DIR__ . '/../Views/mangas/create.php';
    }

    public function store() {
        // Traitement de l'ajout (sera implémenté plus tard)
        echo "Traitement de l'ajout en cours...";
        // Rediriger ou afficher un message
    }

    public function edit($id) {
        // Afficher le formulaire d'édition avec les données du manga
        echo "Formulaire d'édition pour le manga ID: " . $id;
    }

    public function update($id) {
        // Traitement de la modification (sera implémenté plus tard)
        echo "Traitement de la mise à jour pour le manga ID: " . $id;
    }

    public function delete($id) {
        // Traitement de la suppression (sera implémenté plus tard)
        echo "Traitement de la suppression pour le manga ID: " . $id;
    }
}