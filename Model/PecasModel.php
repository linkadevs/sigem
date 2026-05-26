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

    public function solicitarPeca($nome_peca, $quantidade_pecas, $descricao, $id_tecnico)
    {
        try {
            $sql = "INSERT INTO solicitacao_pecas (nome_peca, data, descricao, quantidade_pecas, status, id_tecnico_fk) 
                    VALUES (:nome_peca, NOW(), :descricao, :quantidade_pecas, 'em_aberto', :id_tecnico)";
            $stmt = $this->db->prepare($sql);
            
            return $stmt->execute([
                ':nome_peca' => $nome_peca,
                ':descricao' => $descricao,
                ':quantidade_pecas' => $quantidade_pecas,
                ':id_tecnico' => $id_tecnico
            ]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao solicitar peça: " . $e->getMessage());
        }
    }
}
?>