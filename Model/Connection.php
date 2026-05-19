<?php
namespace Model;
use PDO;
use PDOException;

require_once __DIR__ . '../Config/configuration.php';

class Connection {
    private static $stmt;

    public static function getInstance(){
        try{
            self::$stmt = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8mb4',DB_USER, DB_PASSWORD);

        }catch(PDOException $error){
            die('Erro ao estabelecer conexão com o banco de dados. Código: ' .  $error->getMessage());
        }

        return self::$stmt;
    }
}
?>