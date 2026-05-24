<?php
namespace Model;

require_once __DIR__ . '/../Model/Connection.php';
use PDO;
use PDOException;
use Exception;

class Tecnico{
    private $db;

    public function __construct(){
        $this-> db = Connection::getInstance();
    }

    public function changePassword($nova_senha, $id_tecnico){
        
        try {
            $hashedPassword = password_hash($nova_senha, PASSWORD_DEFAULT);

            $sql = 'UPDATE tecnico SET senha = :senha WHERE id_tecnico = :id_tecnico';

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":senha", $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(":id_tecnico", $id_tecnico, PDO::PARAM_INT);


            return $stmt->execute();

        } catch (PDOException $error) {
            die('Erro ao trocar a senha. Código: '. $error->getMessage());
            return false;
        }
    }
}

?>