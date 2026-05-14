<?php

//Define o "endereço" da classe
namespace Model;

//verifica se o arquivo já foi importado
require_once __DIR__ . '/../Model/Connection.php';

//objetos de erro
use PDO;
use PDOException;

//Definindo o nome da classe.
class GerenciamentoCliente
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

    public function createCliente($nome, $cnpj, $uf, $cidade, $contato, $email, $senha)
    {
        try {
            $sql = "INSERT INTO cliente (nome, cnpj, uf, cidade, contato, email, senha) VALUES (:nome, :cnpj, :uf, :cidade, :contato , :email, :senha)";
            $stmt = $this->db->prepare($sql);

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':cnpj', $cnpj, PDO::PARAM_STR);
            $stmt->bindParam(':uf', $uf, PDO::PARAM_STR);
            $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $stmt->bindParam(':contato', $contato, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senhaHash, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao criar Cliente: " . $e->getMessage());
            return false;
        }
    }

    // Buscar todos
    public function getAllClientes()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM cliente");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar todos os clientes: " . $e->getMessage());
            return [];
        }
    }

    // Buscar por ID
    public function getClienteById($id_cliente)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM cliente WHERE id_cliente = :id_cliente");
            $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar cliente por ID: " . $e->getMessage());
            return null;
        }
    }



    // DELETE - Remover CLiente
    public function deleteCLiente($id_cliente)
    {
        try {
            $sql = "DELETE FROM cliente WHERE id_cliente = :id_cliente";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao deletar cliente: " . $e->getMessage());
            return false;
        }
    }



    public function searchCliente($busca)
    {
        try {

            $sql = "SELECT * FROM cliente
                WHERE nome LIKE :busca
                OR cnpj LIKE :busca
                OR uf LIKE :busca
                OR cidade LIKE :busca
                OR contato LIKE :busca
                OR email LIKE :busca";

            $stmt = $this->db->prepare($sql);

            $busca = "%{$busca}%";

            $stmt->bindValue(':busca', $busca, PDO::PARAM_STR);

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