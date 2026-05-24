<?php
namespace Model;

require_once __DIR__ . '/Connection.php';

use PDO;
use PDOException;
use Exception;
use Model\Connection;

class ManutencaoModel
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function salvarManutencao($dados, $fotos_json)
    {
        try {
            $sql = "INSERT INTO manutencao (tipo_de_servico, descricao_do_servico, acompanhante, pressao_aferida, testes_e_finalizacao, cod_maquina_fk, id_tecnico_fk, fotos) 
                    VALUES (:tipo, :descricao, :acompanhante, :pressao, :testes, :cod_maquina, :id_tecnico, :fotos)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':tipo' => $dados['tipo_de_servico'],
                ':descricao' => $dados['descricao_do_servico'],
                ':acompanhante' => $dados['acompanhante'],
                ':pressao' => $dados['pressao_aferida'],
                ':testes' => $dados['testes_e_finalizacao'],
                ':cod_maquina' => $dados['cod_maquina'],
                ':id_tecnico' => $dados['id_tecnico'],
                ':fotos' => $fotos_json
            ]);
            
            return $this->db->lastInsertId();
            
        } catch (PDOException $e) {
            throw new Exception("Erro ao salvar manutenção: " . $e->getMessage());
        }
    }
}
?>