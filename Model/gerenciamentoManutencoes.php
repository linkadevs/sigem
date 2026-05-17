<?php

namespace Model;
require_once __DIR__ . '/Connection.php';


use PDO;
use PDOException;
use Exception;
use Model\Connection;



class GerenciamentoManutencoes
{
    private $db;


    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function exibirmanutencoes($busca = null)
    {
        try {
            // Verificar se tem busca
            if ($busca && !empty(trim($busca))) {
                // Busca completa incluindo técnico e data/hora
                $sql = "SELECT m.*, maq.nome_maquina, tec.nome AS nome_tecnico 
                        FROM manutencao m
                        LEFT JOIN maquina maq ON m.cod_maquina_fk = maq.cod_maquina
                        LEFT JOIN tecnico tec ON m.id_tecnico_fk = tec.id_tecnico
                        WHERE m.tipo_de_servico LIKE :busca1 
                        OR m.cod_maquina_fk LIKE :busca2
                        OR maq.nome_maquina LIKE :busca3
                        OR tec.nome LIKE :busca4
                        OR m.data_e_hora LIKE :busca5
                        ORDER BY m.data_e_hora DESC";
                $stmt = $this->db->prepare($sql);
                $buscaParam = "%{$busca}%";
                $stmt->bindParam(':busca1', $buscaParam);
                $stmt->bindParam(':busca2', $buscaParam);
                $stmt->bindParam(':busca3', $buscaParam);
                $stmt->bindParam(':busca4', $buscaParam);
                $stmt->bindParam(':busca5', $buscaParam);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Para garantir que nome_maquina e nome_tecnico estejam presentes
                foreach ($result as $i => $row) {
                    if (!isset($result[$i]['nome_maquina']) || empty($result[$i]['nome_maquina'])) {
                        $result[$i]['nome_maquina'] = $this->nome_maquina($row['cod_maquina_fk']);
                    }
                    if (!isset($result[$i]['nome_tecnico']) || empty($result[$i]['nome_tecnico'])) {
                        $result[$i]['nome_tecnico'] = $this->nome_tecnico($row['id_tecnico_fk']);
                    }
                }
            } else {
                $sql = 'SELECT * FROM manutencao ORDER BY data_e_hora DESC';
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $i => $row) {
                    $result[$i]['nome_maquina'] = $this->nome_maquina($row['cod_maquina_fk']);
                    $result[$i]['nome_tecnico'] = $this->nome_tecnico($row['id_tecnico_fk']);
                }
            }
            return $result;

        } catch (PDOException $e) {
            throw new Exception("Erro ao exibir manutenções: " . $e->getMessage());
        }

    }

    public function nome_maquina($cod_maquina)
    {
        try {
            $sql = "SELECT nome_maquina FROM maquina WHERE cod_maquina = :cod_maquina";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':cod_maquina', $cod_maquina);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['nome_maquina'] : null;
        } catch (PDOException $e) {
            throw new Exception("Erro ao obter nome da máquina: " . $e->getMessage());
        }

    }

    public function nome_tecnico($id_tecnico)
    {
        try {
            $sql = "SELECT nome FROM tecnico WHERE id_tecnico = :id_tecnico";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_tecnico', $id_tecnico);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['nome'] : null;
        } catch (PDOException $e) {
            throw new Exception("Erro ao obter nome do técnico: " . $e->getMessage());
        }

    }
}

?>