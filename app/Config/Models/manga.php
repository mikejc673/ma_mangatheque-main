<?php

class Manga {
    private $conn;
    private $table_name = "mangas";

    public $id;
    public $titre;
    public $description;
    public $nb_volumes;
    public $statut;
    public $image_couverture;
    public $note_personnelle;

    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }

    // Méthodes CRUD à implémenter ici
    public function getAll() {
        $query = "SELECT id, titre, description, nb_volumes, statut, image_couverture, note_personnelle FROM " . $this->table_name . " ORDER BY titre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById($id) {
        $query = "SELECT id, titre, description, nb_volumes, statut, image_couverture, note_personnelle FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id = $row['id'];
            $this->titre = $row['titre'];
            $this->description = $row['description'];
            $this->nb_volumes = $row['nb_volumes'];
            $this->statut = $row['statut'];
            $this->image_couverture = $row['image_couverture'];
            $this->note_personnelle = $row['note_personnelle'];
            return true;
        }
        return false;
    }

    // ... d'autres méthodes (create, update, delete) seront ajoutées plus tard
}