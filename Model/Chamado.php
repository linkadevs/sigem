<?php
namespace Model;

use Exception;
use PDOException;
use Model\Connection;
use PDO;

require_once __DIR__ . '/../Model/Connection.php';
require_once __DIR__ . '/../vendor/autoload.php';

class Chamado {
    private PDO $db;

    public function __construct () {
        $this->db = Connection::getInstance();
    }

    public function selecionarTodosOsChamados() :array {
        try {
            $sql = 'SELECT chamado.id_chamado, chamado.status,
            tecnico.nome, cliente.nome 
            FROM chamado 
            LEFT JOIN tecnico
            ON chamado.id_tecnico_fk = tecnico.id_tecnico
            INNER JOIN cliente
            ON chamado.id_cliente_fk = cliente.id_cliente
            ORDER BY data_chamado ASC';
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Erro ao selecionar todos os chamados.');
        }
    }

    public function selecionarChamadosPorCliente (
        int $id_cliente_fk
    ) :array {
        try {
            $sql = 'SELECT chamado.descricao, chamado.status,
            chamado.data_chamado, chamado.fotos, maquina.cod_maquina,
            maquina.nome_maquina FROM chamado
            INNER JOIN maquina
            ON chamado.cod_maquina_fk = maquina.cod_maquina
            WHERE id_cliente_fk = :id_cliente_fk
            ORDER BY data_chamado ASC';

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':id_cliente_fk' => $id_cliente_fk
            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception ('Erro ao selecionar chamados do cliente.');
        }
    }

    // Esse retorna os chamados do técnico + os chamados que estão em aberto
    public function selecionarChamadosPorId (
        int $id_chamado
    ) :?array {
        try {
            $sql = 'SELECT chamado.descricao, chamado.status,
            chamado.data_chamado, chamado.fotos, maquina.nome_maquina,
            maquina.localizacao, maquina.cod_maquina, cliente.nome,
            cliente.cnpj, cliente.uf, cliente.cidade, cliente.contato
            FROM chamado
            INNER JOIN maquina
            ON chamado.cod_maquina_fk = maquina.cod_maquina
            INNER JOIN cliente
            ON chamado.id_cliente_fk = cliente.id_cliente
            WHERE id_chamado = :id_chamado
            LIMIT 1';

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':id_chamado' => $id_chamado,
            ]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (PDOException $e) {
            throw new Exception(
                'Erro ao selecionar chamados por id.',
                0,
                $e
            );
        }
    }

    public function selecionarChamadoPorTecnico (
        int $id_tecnico_fk
    ) :array {
        try {
            $sql = 'SELECT chamado.id_chamado chamado.status,  cliente.nome, tecnico.nome
            FROM chamado
            INNER JOIN cliente
            ON chamado.id_cliente_fk = cliente.id_cliente
            INNER JOIN tecnico
            ON chamado.id_tecnico_fk = tecnico.id_tecnico
            WHERE id_tecnico_fk = :id_tecnico_fk
            ORDER BY data_chamado ASC';

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':id_tecnico_fk' => $id_tecnico_fk
            ]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception (
                'Erro ao selecionar chamados por técnico.',
                0,
                $e
            );
        }
    }
    public function criarChamado () :bool {
        try {
            
        }
    }

}

?>