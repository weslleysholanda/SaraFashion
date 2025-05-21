<?php

class Model
{
    protected static $instance;
    protected $db;

    public function __construct()
    {
        if (!self::$instance) {
            try {
                self::$instance = new PDO(
                    'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST,
                    DB_USER,
                    DB_PASS,
                    [
                        PDO::ATTR_PERSISTENT => true,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    ]
                );
            } catch (PDOException $e) {
                die("Falha de conexão: " . $e->getMessage());
            }
        }
        $this->db = self::$instance;
    }
}
