<?php

namespace Model;
require_once __DIR__ . '/../Model/Connection.php';

use PDO;
use PDOException;
use Exception;
use Model\Connection;


class Historico
{

    private $db;
    public function __construct()
    {
        $this->db = Connection::getInstance();
    }


    public function Obterhistorico($cod_maquina)
    {
        try {
            //BUSCA TODAS AS MANUTENÇÕES DA MÁQUINA
            $sql = "SELECT id_manutencao, tipo_de_servico, data_e_hora, id_tecnico_fk
        FROM manutencao
        WHERE cod_maquina_fk= :cod_maquina_fk";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":cod_maquina_fk", $cod_maquina, PDO::PARAM_STR);
            $stmt->execute();
            $manutencoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($manutencoes)) {
                return [];
            }

            //BUSCA O NOME DE CADA TÉCNICO RESPONSÁVEL POR CADA MANUTENÇÃO
            foreach ($manutencoes as $Key => $manutencao) {
                if (!empty($manutencao['id_tecnico_fk'])) {
                    $sql = "SELECT nome FROM tecnico WHERE id_tecnico = :id_tecnico";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(":id_tecnico", $manutencao['id_tecnico_fk'], PDO::PARAM_INT);
                    $stmt->execute();
                    $tecnico = $stmt->fetch(PDO::FETCH_ASSOC);
                    $manutencoes[$Key]['nome_tecnico'] = $tecnico['nome'] ?? 'Não atribuído';

                } else {
                    $manutencoes[$Key]['nome_tecnico'] = 'Não atribuído';
                }
            }
            return $manutencoes;
        } catch (Exception $e) {
            throw new Exception("Erro ao obter histórico: " . $e->getMessage());
        }
    }

public function barra_de_Pesquisa($cod_maquina, $filtro)
{
    try {
        $filtro_busca = '%' . $filtro . '%';
        
      
        $sql = "SELECT id_manutencao, tipo_de_servico, data_e_hora, id_tecnico_fk
                FROM manutencao
                WHERE cod_maquina_fk = :cod_maquina_fk
                AND (
                    DATE(data_e_hora) LIKE :filtro_data
                    OR id_tecnico_fk IN (SELECT id_tecnico FROM tecnico WHERE nome LIKE :filtro_nome)
                    OR tipo_de_servico LIKE :filtro_servico
                ) 
                ORDER BY data_e_hora DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":cod_maquina_fk", $cod_maquina, PDO::PARAM_STR);
        $stmt->bindParam(":filtro_data", $filtro_busca, PDO::PARAM_STR);
        $stmt->bindParam(":filtro_nome", $filtro_busca, PDO::PARAM_STR);
        $stmt->bindParam(":filtro_servico", $filtro_busca, PDO::PARAM_STR);
        $stmt->execute();

        $manutencoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($manutencoes)) {
            return [];
        }

        foreach ($manutencoes as $key => $manutencao) {
            if (!empty($manutencao['id_tecnico_fk'])) {
                $sqlTec = "SELECT nome FROM tecnico WHERE id_tecnico = :id_tecnico";
                $stmtTec = $this->db->prepare($sqlTec);
                $stmtTec->bindParam(":id_tecnico", $manutencao['id_tecnico_fk'], PDO::PARAM_INT);
                $stmtTec->execute();
                $tecnico = $stmtTec->fetch(PDO::FETCH_ASSOC);
                $manutencoes[$key]['nome_tecnico'] = $tecnico['nome'] ?? 'Não atribuído';
            } else {
                $manutencoes[$key]['nome_tecnico'] = 'Não atribuído';
            }
        }

        return $manutencoes;

    } catch (Exception $e) {
        throw new Exception("Ocorreu um erro na busca: " . $e->getMessage());
    }
}

}

?>