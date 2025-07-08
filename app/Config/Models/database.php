<?php

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Afficher les erreurs PDO
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Récupérer les résultats sous forme de tableau associatif
            PDO::ATTR_EMULATE_PREPARES   => false,                  // Désactiver l'émulation des requêtes préparées pour de meilleures performances et sécurité
        ];
        try {
            $this->conn = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (\PDOException $e) {
            // En cas d'erreur de connexion, vous pouvez loguer l'erreur ou afficher un message générique
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}