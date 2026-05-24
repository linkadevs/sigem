<?php
namespace Model;

require_once __DIR__ . '/Connection.php';

use PDO;
use PDOException;
use Exception;
use Model\Connection;

class PecasModel
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function tecnico_nome($id_tecnico)
    {
        try {
            $sql = 'SELECT nome FROM tecnico WHERE id_tecnico = :id_tecnico';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_tecnico', $id_tecnico, PDO::PARAM_INT);
            $stmt->execute();
            $nome_tecnico = $stmt->fetch(PDO::FETCH_ASSOC);
            return $nome_tecnico;
        } catch (PDOException $e) {
            throw new Exception("Erro ao obter o nome do técnico: " . $e->getMessage());
        }
    }

    public function solicitarPeca($nome_peca, $descricao, $id_tecnico, $status)
    {
        try {
            $sql = "INSERT INTO solicitacao_pecas (nome_peca, descricao, id_tecnico_fk, status) 
                    VALUES (:nome_peca, :descricao, :id_tecnico, :status)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nome_peca', $nome_peca, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':id_tecnico', $id_tecnico, PDO::PARAM_INT);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erro ao solicitar peça: " . $e->getMessage());
        }
    }
}
?>