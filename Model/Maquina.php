<?php

namespace Model;

use Model\Connection;
use PDO;

require_once __DIR__ . '/Connection.php';

class Maquina {
    private $db;

    public function __construct() {
        $this->db = Connection::getInstance();
    }

    public function criarMaquina(
        string $cod_maquina,
        string $nome_maquina,
        string $localizacao,
        string $marca,
        string $modelo,
        string $fluido_refrigerante,
        string $capacidade_termica_de_refrigeracao,
        int $id_cliente_fk
    ) {
        $sql = 'INSERT INTO maquina
        (cod_maquina, nome_maquina,
        localizacao, marca, modelo,
        fluido_refrigerante,
        capacidade_termica_de_refrigeracao,
        id_cliente_fk) VALUES
        (:cod_maquina, :nome_maquina,
        :localizacao, :marca, :modelo,
        :fluido_refrigerante,
        :capacidade_termica_de_refrigeracao,
        :id_cliente_fk)';

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':cod_maquina' => $cod_maquina,
            ':nome_maquina' => $nome_maquina,
            ':localizacao' => $localizacao,
            ':marca' => $marca,
            ':modelo' => $modelo,
            ':fluido_refrigerante' => $fluido_refrigerante,
            ':capacidade_termica_de_refrigeracao' => $capacidade_termica_de_refrigeracao,
            ':id_cliente_fk' => $id_cliente_fk
        ]);

        return $cod_maquina;
    }

    public function editarMaquina(
        string $cod_maquina,
        string $nome_maquina,
        string $localizacao,
        string $marca,
        string $modelo,
        string $fluido_refrigerante,
        int $capacidade_termica_de_refrigeracao
    ) {
        $sql = 'UPDATE maquina SET
        nome_maquina = :nome_maquina,
        localizacao = :localizacao,
        marca = :marca,
        modelo = :modelo,
        fluido_refrigerante = :fluido_refrigerante,
        capacidade_termica_de_refrigeracao = :capacidade_termica_de_refrigeracao
        WHERE cod_maquina = :cod_maquina';

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nome_maquina' => $nome_maquina,
            ':localizacao' => $localizacao,
            ':marca' => $marca,
            ':modelo' => $modelo,
            ':fluido_refrigerante' => $fluido_refrigerante,
            ':capacidade_termica_de_refrigeracao' => $capacidade_termica_de_refrigeracao,
            ':cod_maquina' => $cod_maquina
        ]);
    }

    public function deletarMaquina(
        string $cod_maquina
    ) {
        $sql = 'DELETE FROM maquina WHERE cod_maquina = :cod_maquina';

        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':cod_maquina' => $cod_maquina
        ]);
    }

    public function verMaquinas () {
        $sql = 'SELECT * FROM maquina';

        $result = $this->db->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verMaquinasPorCliente (
        int $id_cliente_fk
    ) {
        $sql = 'SELECT * FROM maquina WHERE id_cliente_fk = :id_cliente_fk';

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id_cliente_fk' => $id_cliente_fk
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verMaquinaPorCodigo ($cod_maquina) {
        $sql = 'SELECT * FROM maquina WHERE cod_maquina = :cod_maquina';

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':cod_maquina' => $cod_maquina
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function pesquisarMaquina ($pesquisa) {
        $pesquisaFormatada = '%'.$pesquisa.'%'; 
        $sql = 'SELECT maquina.cod_maquina,
                maquina.nome_maquina,
                maquina.localizacao,
                maquina.marca,
                maquina.modelo,
                maquina.fluido_refrigerante,
                maquina.capacidade_termica_de_refrigeracao
                FROM maquina
                INNER JOIN cliente
                ON maquina.id_cliente_fk = cliente.id_cliente
                WHERE maquina.cod_maquina LIKE :pesquisa1
                OR maquina.nome_maquina LIKE :pesquisa2
                OR cliente.nome LIKE :pesquisa3;';
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':pesquisa1' => $pesquisaFormatada,
            ':pesquisa2' => $pesquisaFormatada,
            ':pesquisa3' => $pesquisaFormatada
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>