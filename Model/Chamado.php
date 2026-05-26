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
            $sql = 'SELECT c.id_chamado,
            c.status AS status_chamado,
            t.nome AS nome_tecnico,
            cl.nome AS nome_cliente
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
            $sql = 'SELECT c.id_chamado,
            c.descricao AS descricao_chamado,
            c.status AS status_chamado,
            DATE_FORMAT(c.data_chamado, "%d/%m/%Y") AS data_chamado,
            c.fotos AS fotos_chamado,
            m.cod_maquina,
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
            throw new Exception (
                'Erro ao selecionar chamados do cliente.',
                0,
                $e
            );
        }
    }

    // Esse retorna os chamados do técnico + os chamados que estão em aberto
    public function selecionarChamadosPorId (
        int $id_chamado
    ) :?array {
        try {
            $sql = 'SELECT c.descricao AS descricao_chamado, c.status AS status_chamado,
            DATE_FORMAT(c.data_chamado, "%d/%m/%Y") AS data_chamado, c.fotos AS fotos_chamado, m.nome_maquina,
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
            LEFT JOIN tecnico t
            ON c.id_tecnico_fk = t.id_tecnico
            WHERE c.id_tecnico_fk = :id_tecnico_fk OR c.status = "aberto"
            ORDER BY CASE
            WHEN c.status = "aberto" THEN 1
            WHEN c.status = "em_andamento" THEN 2
            END ASC,
            data_chamado ASC';

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
        string $fotos,
        int $id_cliente_fk,
        string $cod_maquina_fk
    ) :bool {
        try {
            $sql = 'INSERT INTO chamado
            (descricao, status, data_chamado, fotos, id_cliente_fk, cod_maquina_fk)
            VALUES (:descricao, "aberto", CURDATE(), :fotos, :id_cliente_fk, :cod_maquina_fk)';

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':descricao' => $descricao,
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
            $sql = 'DELETE FROM chamado WHERE id_chamado = :id_chamado';
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

    public function pesquisarChamado (
        string $pesquisa
    ) :array {
        try {
            $pesquisaFormatada = '%'.$pesquisa.'%';
            $sql = 'SELECT
            c.id_chamado,
            c.status AS status_chamado,
            c.data_chamado,
            c.descricao AS descricao_chamado,
            c.fotos AS fotos_chamado,
            cl.nome AS nome_cliente,
            cl.cnpj AS cnpj_cliente,
            cl.uf AS uf_cliente,
            cl.cidade AS cidade_cliente,
            cl.contato AS contato_cliente,
            m.cod_maquina,
            m.nome_maquina,
            m.localizacao AS localizacao_maquina,
            t.nome AS nome_tecnico
            FROM chamado c
            INNER JOIN cliente cl
            ON c.id_cliente_fk = cl.id_cliente
            INNER JOIN maquina m
            ON c.cod_maquina_fk = m.cod_maquina
            LEFT JOIN tecnico t
            ON c.id_tecnico_fk = t.id_tecnico
            WHERE (
                cl.nome LIKE :pesquisa1 OR
                cl.uf LIKE :pesquisa2 OR
                cl.cnpj LIKE :pesquisa3 OR
                c.cod_maquina_fk LIKE :pesquisa4 OR
                t.nome LIKE :pesquisa5
            )
            ORDER BY CASE 
                WHEN c.status = "em_andamento" THEN 1
                WHEN c.status = "aberto" THEN 2
                WHEN c.status = "resolvido" THEN 3
            END ASC,
            c.data_chamado ASC';
    
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':pesquisa1' => $pesquisaFormatada,
                ':pesquisa2' => $pesquisaFormatada,
                ':pesquisa3' => $pesquisaFormatada,
                ':pesquisa4' => $pesquisaFormatada,
                ':pesquisa5' => $pesquisaFormatada
            ]);
    
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception(
                'Erro ao pesquisar chamado.',
                0,
                $e
            );
        }
    }

    public function pesquisarChamadoCliente (
        string $pesquisa,
        int $id_cliente
    ) :array {
        try {
            $pesquisaFormatada = '%'.$pesquisa.'%';
            $sql = 'SELECT
            c.id_chamado,
            c.status AS status_chamado,
            DATE_FORMAT(c.data_chamado, "%d/%m/%Y") AS data_chamado,
            c.descricao AS descricao_chamado,
            c.fotos AS fotos_chamado,
            m.cod_maquina,
            m.nome_maquina
            FROM chamado c
            INNER JOIN maquina m
            ON c.cod_maquina_fk = m.cod_maquina
            INNER JOIN cliente cl
            ON c.id_cliente_fk = cl.id_cliente
            WHERE (
                DATE_FORMAT(c.data_chamado, "%d/%m/%Y") LIKE :pesquisa1
                OR m.cod_maquina LIKE :pesquisa2
                OR m.nome_maquina LIKE :pesquisa3
            ) AND cl.id_cliente = :id_cliente
            ORDER BY CASE 
                WHEN c.status = "em andamento" THEN 1
                WHEN c.status = "aberto" THEN 2
                WHEN c.status = "resolvido" THEN 3
            END ASC,
            c.data_chamado ASC';

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':id_cliente' => $id_cliente,
                ':pesquisa1' => $pesquisaFormatada,
                ':pesquisa2' => $pesquisaFormatada,
                ':pesquisa3' => $pesquisaFormatada
            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception(
                'Erro ao pesquisar chamados.',
                0,
                $e
            );
        }
    }

    public function pesquisarChamadoTecnico (
        string $pesquisa,
        int $id_tecnico
    ) :array {
        try {
            $pesquisaFormatada = '%'.$pesquisa.'%';
            $sql = 'SELECT
            c.id_chamado,
            c.status AS status_chamado,
            cl.nome AS nome_cliente,
            t.nome AS nome_tecnico
            FROM chamado c
            INNER JOIN maquina m
            ON c.cod_maquina_fk = m.cod_maquina
            INNER JOIN cliente cl
            ON c.id_cliente_fk = cl.id_cliente
            LEFT JOIN tecnico t
            ON c.id_tecnico_fk = t.id_tecnico
            WHERE (
                cl.nome LIKE :pesquisa1 OR
                cl.uf LIKE :pesquisa2 OR
                cl.cnpj LIKE :pesquisa3 OR
                c.cod_maquina_fk LIKE :pesquisa4 OR
                t.nome LIKE :pesquisa5
            ) AND (
            c.id_tecnico_fk = :id_tecnico
            OR c.status = "aberto"
            )
            ORDER BY CASE 
            WHEN c.status = "em andamento" THEN 1
            WHEN c.status = "aberto" THEN 2
            WHEN c.status = "resolvido" THEN 3
            END ASC,
            c.data_chamado ASC';

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':id_tecnico' => $id_tecnico,
                ':pesquisa1' => $pesquisaFormatada,
                ':pesquisa2' => $pesquisaFormatada,
                ':pesquisa3' => $pesquisaFormatada,
                ':pesquisa4' => $pesquisaFormatada,
                ':pesquisa5' => $pesquisaFormatada
            ]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception(
                'Erro ao pesquisar chamados.',
                0,
                $e
            );
        }
    }

    public function responsabilizarse (
        int $id_tecnico,
        int $id_chamado
    ) :bool {
        try {
            $sql = 'UPDATE chamado SET
            id_tecnico_fk = :id_tecnico_fk,
            status = "em_andamento"
            WHERE id_chamado = :id_chamado';

            $stmt = $this->db->prepare ($sql);

            return $stmt->execute([
                ':id_tecnico_fk' => $id_tecnico,
                ':id_chamado' => $id_chamado
            ]);
        } catch (PDOException $e) {
            throw new Exception(
                'Erro ao responsabilizar técnico ao chamado.',
                0,
                $e
            );
        }
    }
    public function cancelar (
        int $id_chamado
    ) :bool {
        try {
            $sql = 'UPDATE chamado SET
            id_tecnico_fk = NULL,
            status = "aberto"
            WHERE id_chamado = :id_chamado';

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':id_chamado' => $id_chamado
            ]);
        } catch (PDOException $e) {
            throw new Exception(
                'Erro ao cancelar responsabilidade do chamado.',
                0,
                $e
            );
        }
    }

    public function finalizarChamado (
        int $id_chamado
    ) :bool {
        try {
            $sql = 'UPDATE chamado SET
            status = "resolvido"
            WHERE id_chamado = :id_chamado';

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':id_chamado' => $id_chamado
            ]);
        } catch (PDOException $e) {
            throw new Exception(
                'Erro ao resolver chamado',
                0,
                $e
            );
        }
    }
}

?>