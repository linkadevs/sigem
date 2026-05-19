<?php
namespace Model;

require_once __DIR__ . '../Model/Connection.php';
use PDO;
use PDOException;
use Exception;

class Administrador{
    private $db;

    public function __construct(){
        $this-> db = Connection::getInstance();
    }

    public function updateUserAdm($nome_adm, $cpf_adm, $email_adm, $id_adm){
        try{
            $sql = 'UPDATE administrador SET nome = :nome, cpf = :cpf, email = :email WHERE id_administrador = :id_administrador';
            
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":id_administrador", $id_adm, PDO::PARAM_INT);
            $stmt->bindParam(":nome", $nome_adm, PDO::PARAM_STR);
            $stmt->bindParam(":cpf", $cpf_adm, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email_adm, PDO::PARAM_STR);

            return $stmt-> execute();

        }catch(PDOException $error){
            die('Erro ao alterar as informações. Código: '. $error->getMessage());
            return false;
        }
    }

    public function changePassword($nova_senha, $id_adm){
        
        try {
            $hashedPassword = password_hash($nova_senha, PASSWORD_DEFAULT);

            $sql = 'UPDATE administrador SET senha = :senha WHERE id_administrador = :id_administrador';

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(":senha", $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(":id_administrador", $id_adm, PDO::PARAM_INT);


            return $stmt->execute();

        } catch (PDOException $error) {
            die('Erro ao trocar a senha. Código: '. $error->getMessage());
            return false;
        }
    }
}

?>