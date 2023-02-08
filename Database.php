<?php

require_once 'env.php';

class Database {
    private $username;
    private $password;
    private $host;
    private $database;

    private static $instance;

    private function __construct() {
        $this->username = DB_USER;
        $this->password = DB_PASSWORD;
        $this->host = DB_HOST;
        $this->database = DB_NAME;
    }

    public static function getInstance(): Database {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function connect() {
        try {
            $connection = new PDO(
                "pgsql:host=$this->host;port=5432;dbname=$this->database",
                $this->username,
                $this->password
            );

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connection;

        } catch (PDOException $e) {
            die("Connection to database failed: " . $e->getMessage());
        }
    }
}