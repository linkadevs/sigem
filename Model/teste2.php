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
    public function deleteCliente($id_cliente)
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
                WHERE nome LIKE :nome
                OR cnpj LIKE :cnpj
                OR uf LIKE :uf
                OR cidade LIKE :cidade
                OR contato LIKE :contato
                OR email LIKE :email";

        $stmt = $this->db->prepare($sql);

        $busca = '%' . trim($busca) . '%';

        $stmt->bindValue(':nome', $busca, PDO::PARAM_STR);
        $stmt->bindValue(':cnpj', $busca, PDO::PARAM_STR);
        $stmt->bindValue(':uf', $busca, PDO::PARAM_STR);
        $stmt->bindValue(':cidade', $busca, PDO::PARAM_STR);
        $stmt->bindValue(':contato', $busca, PDO::PARAM_STR);
        $stmt->bindValue(':email', $busca, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        die($e->getMessage());
    }
}
}


?>