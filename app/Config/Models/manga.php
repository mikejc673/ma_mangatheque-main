<?php

class Manga {
    private $conn;
    private $table_name = "mangas";

    public $id;
    public $titre;
    public $auteurs;
    public $description;
    public $nb_volumes;
    public $statut;



    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }

    // Lire tous les mangas
    public function getAll() {
        $query = "SELECT id, titre, description, nb_volumes, auteurs FROM " . $this->table_name . " ORDER BY titre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Lire un seul manga par ID
    public function getById($id) {
        $query = "SELECT id, titre, description, nb_volumes, statut, auteurs FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
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
            $this->auteurs = $row['auteurs'];
            return true;
        }
        return false;
    }

    // Créer un manga
    public function create() {
        // Requête d'insertion
        $query = "INSERT INTO " . $this->table_name . "
                  SET
                    titre = :titre,
                    description = :description,
                    nb_volumes = :nb_volumes,
                    statut = :statut,
                    auteurs = :auteurs";

        // Préparation de la requête
        $stmt = $this->conn->prepare($query);

        // Nettoyage des données (sécurité contre les injections HTML/JS)
        $this->titre = htmlspecialchars(strip_tags($this->titre));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->auteurs = htmlspecialchars(strip_tags($this->auteurs));
        $this->nb_volumes = htmlspecialchars(strip_tags($this->nb_volumes));
        $this->statut = htmlspecialchars(strip_tags($this->statut));


        // Liaison des valeurs
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':nb_volumes', $this->nb_volumes);
        $stmt->bindParam(':statut', $this->statut);
        $stmt->bindParam(':auteurs', $this->auteurs);

        // Exécution de la requête
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Mettre à jour un manga
    public function update() {
        // Requête de mise à jour
        $query = "UPDATE " . $this->table_name . "
                  SET
                    titre = :titre,
                    description = :description,
                    nb_volumes = :nb_volumes,
                    statut = :statut,
                    auteurs = :auteurs
                  WHERE
                    id = :id";

        // Préparation de la requête
        $stmt = $this->conn->prepare($query);

        // Nettoyage des données
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->titre = htmlspecialchars(strip_tags($this->titre));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->nb_volumes = htmlspecialchars(strip_tags($this->nb_volumes));
        $this->statut = htmlspecialchars(strip_tags($this->statut));
        $this->auteurs = htmlspecialchars(strip_tags($this->auteurs));

        // Liaison des valeurs
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':titre', $this->titre);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':nb_volumes', $this->nb_volumes);
        $stmt->bindParam(':statut', $this->statut);
        $stmt->bindParam(':auteurs', $this->auteurs);

        // Exécution de la requête
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Supprimer un manga
    public function delete() {
        // Requête de suppression
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // Préparation de la requête
        $stmt = $this->conn->prepare($query);

        // Nettoyage de l'ID
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Liaison de l'ID
        $stmt->bindParam(1, $this->id);

        // Exécution de la requête
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}