<?php

namespace Model;

require_once __DIR__ . '/Connection.php';

use Exception;
use Model\Connection;
use PDO;
use PDOException;

class PaginainicialModel
{
    private $db;
    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function consultar_ultima_manutencao($cod_maquina_fk)
    {
        try {
            $sql = "SELECT m.*, t.nome AS nome_tecnico
                    FROM manutencao AS m
                    LEFT JOIN tecnico AS t ON m.id_tecnico_fk = t.id_tecnico
                    WHERE m.cod_maquina_fk = :cod_maquina_fk
                    ORDER BY m.id_manutencao DESC
                    LIMIT 1";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':cod_maquina_fk', $cod_maquina_fk, PDO::PARAM_STR);
            $stmt->execute();
            $manutencaoinfor = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$manutencaoinfor) {
                return null;
            }

            if (empty($manutencaoinfor['nome_tecnico'])) {
                $manutencaoinfor['nome_tecnico'] = 'Não atribuído';
            }

            return $manutencaoinfor;

        } catch (PDOException $erro) {
            throw new Exception('Erro ao consultar manutenção: ' . $erro->getMessage());
        }
    }

    public function nome_tecnico($id_tecnico)
    {
        try {
        $sql = 'SELECT nome FROM tecnico WHERE id_tecnico = :id_tecnico';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_tecnico', $id_tecnico, PDO::PARAM_INT);
        $stmt->execute();
        $tecnicoinfor = $stmt->fetch(PDO::FETCH_ASSOC);
        return $tecnicoinfor ? $tecnicoinfor['nome'] : null;

        } catch (PDOException $erro) {
            throw new Exception('Erro ao consultar nome do técnico: ' . $erro);
        }
    }
}

?>