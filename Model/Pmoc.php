<?php

namespace Model;
require_once __DIR__ . '/Connection.php';
use PDO;
use PDOException;
use Exception;
use Model\Connection;

class Pmoc
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    // ==============================================
    // 1. DADOS DA MÁQUINA
    // ==============================================
    public function dadosmaquina($cod_maquina)
    {
        try {
            $sql = "SELECT * FROM maquina
                    WHERE cod_maquina = :cod_maquina";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':cod_maquina', $cod_maquina, PDO::PARAM_STR);
            $stmt->execute();
            $informaquinas = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($informaquinas && !empty($informaquinas['id_cliente_fk'])) {
                $cliente = $this->dadoscliente($informaquinas['id_cliente_fk']);
                $informaquinas['nome_cliente'] = $cliente['nome'] ?? 'Cliente não encontrado';
            }

            return $informaquinas;

        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar dados da máquina: " . $e->getMessage());
        }
    }

    // ==============================================
    // 2. DADOS DA MANUTENÇÃO
    // ==============================================
    public function dadosmanutencao($cod_maquina, $id_manutencao)
    {
        try {
            $sql = 'SELECT * FROM manutencao 
                    WHERE cod_maquina_fk = :cod_maquina AND id_manutencao = :id_manutencao';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':cod_maquina', $cod_maquina, PDO::PARAM_STR);
            $stmt->bindParam(':id_manutencao', $id_manutencao, PDO::PARAM_INT);
            $stmt->execute();
            $informanutencoes = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $informanutencoes;

        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar dados da manutenção: " . $e->getMessage());
        }
    }

    // ==============================================
    // 3. DADOS DO TÉCNICO
    // ==============================================
    public function dadostecnico($id_tecnico)
    {
        try {
            $sql = 'SELECT nome FROM tecnico 
                    WHERE id_tecnico = :id_tecnico';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_tecnico', $id_tecnico, PDO::PARAM_INT);
            $stmt->execute();
            $infortecnico = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $infortecnico;

        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar dados do técnico: " . $e->getMessage());
        }
    }

    // ==============================================
    // 4. DADOS DO CLIENTE
    // ==============================================
    public function dadoscliente($id_cliente)
    {
        try {
            $sql = 'SELECT nome FROM cliente 
                    WHERE id_cliente = :id_cliente';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $stmt->execute();
            $inforcliente = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $inforcliente;

        } catch (PDOException $e) {
            throw new Exception("Erro ao buscar dados do cliente: " . $e->getMessage());
        }
    }
}
?>