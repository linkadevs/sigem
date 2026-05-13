<?php
namespace Model;

require_once __DIR__ . '../Model/Connection.php';
use PDO;
use PDOException;
use Exception;

class Cliente{
    private $db;

    public function __construct(){
        $this-> db = Connection::getInstance();
    }

    public function changePassword($nova_senha, $id_cliente){
        
        try {
            $hashedPassword = password_hash($nova_senha, PASSWORD_DEFAULT);

            $sql = 'UPDATE cliente SET senha = :senha WHERE id_cliente = :id_cliente';

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":senha", $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);


            return $stmt->execute();

        } catch (PDOException $error) {
            die('Erro ao trocar a senha. Código: '. $error->getMessage());
            return false;
        }
    }
}

?>