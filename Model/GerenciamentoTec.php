<?php

//Define o "endereço" da classe
namespace Model;

//verifica se o arquivo já foi importado
require_once __DIR__ . '/../Model/Connection.php';

//objetos de erro
use PDO;
use PDOException;

//Definindo o nome da classe.
class GerenciamentoTec
{

    //Este é um atributo (ou propriedade) privado. Ele serve para armazenar 
// a instância da conexão com o banco de dados
    private $db;

    //Este é o método construtor. 
    // Ele é executado automaticamente assim que você cria um novo objeto da classe
    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    // Criar técnico
    public function createTec($nome, $cpf, $funcao, $email, $senha)
    {
        try {
            $sql = "INSERT INTO tecnico (nome, cpf, funcao, email, senha) VALUES (:nome, :cpf, :funcao, :email, :senha)";
            $stmt = $this->db->prepare($sql);

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $stmt->bindParam(':funcao', $funcao, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senhaHash, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao criar técnico: " . $e->getMessage());
            return false;
        }
    }


    // Buscar todos
    public function getAllTecs()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM tecnico");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar todos os técnicos: " . $e->getMessage());
            return [];
        }
    }

    // Buscar por ID
    public function getTecById($id_tecnico)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM tecnico WHERE id_tecnico = :id_tecnico");
            $stmt->bindParam(':id_tecnico', $id_tecnico, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar técnico por ID: " . $e->getMessage());
            return null;
        }
    }
    //Atualizar técnico
public function updateTec($id, $nome, $cpf, $funcao, $email, $senha) {
    try {
        $sql = "UPDATE tecnico SET nome = :nome, cpf = :cpf, funcao = :funcao, email = :email, senha = :senha WHERE id_tecnico = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id, 
            ':nome' => $nome, 
            ':cpf' => $cpf, 
            ':funcao' => $funcao, 
            ':email' => $email,
            ':senha' => $senha
        ]);
    } catch (PDOException $e) {
        error_log("Erro ao atualizar: " . $e->getMessage());
        return false;
    }
}
public function updateTecSemSenha($id, $nome, $cpf, $funcao, $email) {
    try {
        $sql = "UPDATE tecnico SET nome = :nome, cpf = :cpf, funcao = :funcao, email = :email WHERE id_tecnico = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id, 
            ':nome' => $nome, 
            ':cpf' => $cpf, 
            ':funcao' => $funcao, 
            ':email' => $email
        ]);
    } catch (PDOException $e) {
        error_log("Erro ao atualizar: " . $e->getMessage());
        return false;
    }
}



    // DELETE - Remover técnico
    public function deleteTec($id_tecnico)
    {
        try {
            $sql = "DELETE FROM tecnico WHERE id_tecnico = :id_tecnico";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_tecnico', $id_tecnico, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao deletar técnico: " . $e->getMessage());
            return false;
        }
    }

    //Busca Extra
    public function getTecByEmail($email)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM tecnico WHERE email = :email");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar técnico por email: " . $e->getMessage());
            return false;
        }
    }




    public function getTecByFuncao($funcao)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM tecnico WHERE funcao = :funcao");
            $stmt->bindParam(":funcao", $funcao, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar técnico por função: " . $e->getMessage());
            return false;
        }
    }

    public function searchTec($busca)
    {
        try {

            $sql = "
            SELECT *
            FROM tecnico
            WHERE
            nome LIKE :busca1
            OR cpf LIKE :busca2
            OR funcao LIKE :busca3
            OR email LIKE :busca4
            ";

            $stmt = $this->db->prepare($sql);
            $busca = "%{$busca}%";
            $stmt->bindValue(':busca1', $busca, PDO::PARAM_STR);
            $stmt->bindValue(':busca2', $busca, PDO::PARAM_STR);
            $stmt->bindValue(':busca3', $busca, PDO::PARAM_STR);
            $stmt->bindValue(':busca4', $busca, PDO::PARAM_STR);


            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            error_log(
                'Erro na pesquisa: ' .
                $e->getMessage()
            );

            return [];
        }
    }
}


?>