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
            $sql = 'SELECT c.id_chamado, c.status,
            t.nome, cl.nome 
            FROM chamado c
            LEFT JOIN tecnico t
            ON c.id_tecnico_fk = t.id_tecnico
            INNER JOIN cliente cl
            ON c.id_cliente_fk = cl.id_cliente
            ORDER BY c.data_chamado ASC';
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
            $sql = 'SELECT c.descricao, c.status,
            c.data_c, c.fotos, m.cod_maquina,
            m.nome_maquina FROM chamado c
            INNER JOIN maquina m
            ON c.cod_maquina_fk = m.cod_maquina
            WHERE c.id_cliente_fk = :id_cliente_fk
            ORDER BY c.data_chamado ASC';

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
            $sql = 'SELECT c.descricao AS descricao_chamado, c.status AS status_chamado,
            c.data_chamado, c.fotos AS fotos_chamado, m.nome_maquina,
            m.localizacao AS localizacao_maquina, m.cod_maquina, cl.nome AS nome_cliente,
            cl.cnpj AS cnpj_cliente, cl.uf AS uf_cliente, cl.cidade AS cidade_cliente, cl.contato AS contato_cliente
            FROM chamado c
            INNER JOIN maquina m
            ON c.cod_maquina_fk = m.cod_maquina
            INNER JOIN cliente cl
            ON c.id_cliente_fk = cl.id_cliente
            WHERE c.id_chamado = :id_chamado
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

    public function selecionarChamadosPorTecnico (
        int $id_tecnico_fk
    ) :array {
        try {
            $sql = 'SELECT c.id_chamado, c.status AS status_chamado, cl.nome AS nome_cliente, t.nome AS nome_tecnico
            FROM chamado c
            INNER JOIN cliente cl
            ON c.id_cliente_fk = cl.id_cliente
            INNER JOIN tecnico t
            ON c.id_tecnico_fk = t.id_tecnico
            WHERE c.id_tecnico_fk = :id_tecnico_fk
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
    public function abrirChamado (
        string $descricao,
        string $status,
        string $fotos,
        int $id_cliente_fk,
        string $cod_maquina_fk
    ) :bool {
        try {
            $sql = 'INSERT INTO chamado c
            (c.descricao, c.status, c.data_chamado, c.fotos, c.id_cliente_fk, c.cod_maquina_fk)
            VALUES (:descricao, :status, CURDATE(), :fotos, :id_cliente_fk, :cod_maquina_fk)';

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':descricao' => $descricao,
                ':status' => $status,
                ':fotos' => $fotos,
                ':id_cliente_fk' => $id_cliente_fk,
                ':cod_maquina_fk' => $cod_maquina_fk
            ]);
        } catch (PDOException $e) {
            throw new Exception (
                'Erro ao abrir chamado.',
                0,
                $e
            );
        }
    }

    public function deletarChamado (
        int $id_chamado
    ) :bool {
        try {
            $sql = 'DELETE FROM chamado c WHERE c.id_chamado = :id_chamado';
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':id_chamado' => $id_chamado
            ]);
        } catch (PDOException $e) {
            throw new Exception (
                'Erro ao deletar chamado',
                0,
                $e
            );
        }
    }
}

?>