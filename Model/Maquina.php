<?php

namespace Model;

use Model\Connection;
use PDOException;
use PDO;

require_once __DIR__ . 'Connection.php';

class Maquina {
    private $maquina;

    public function __construct() {
        $this->maquina = Connection::getInstance();
    }

    public function criarMaquina(
        string $cod_maquina,
        string $nome_maquina,
        string $localizacao,
        string $marca,
        string $modelo,
        string $fluido_refrigerante,
        int $capacidade_termica_de_refrigeracao,
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

        $stmt = $this->maquina->prepare($sql);

        return $stmt->execute([
            ':cod_maquina' => $cod_maquina,
            ':nome_maquina' => $nome_maquina,
            ':localizacao' => $localizacao,
            ':marca' => $marca,
            ':modelo' => $modelo,
            ':fluido_refrigerante' => $fluido_refrigerante,
            ':capacidade_termica_de_refrigeracao' => $capacidade_termica_de_refrigeracao,
            ':id_cliente_fk' => $id_cliente_fk
        ]);
    }

    public function editarMaquina(
        string $cod_maquina,
        string $nome_maquina,
        string $localizacao,
        string $marca,
        string $modelo,
        string $fluido_refrigerante,
        int $capacidade_termica_de_refrigeracao,
        int $id_cliente_fk
    ) {
        $sql = 'UPDATE maquina SET
        nome_maquina = :nome_maquina,
        localizacao = :localizacao,
        marca = :marca
        modelo = :modelo
        fluido_refrigerante = :fluido_refrigerante,
        capacidade_termica_de_refrigeracao = :capacidade_termica_de_refrigeracao
        WHERE cod_maquina = :cod_maquina';

        $stmt = $this->maquina->prepare($sql);

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

        $stmt = $this->maquina->prepare($sql);
        
        return $stmt->execute([
            ':cod_maquina' => $cod_maquina
        ]);
    }

    public function verMaquinas () {
        $sql = 'SELECT * FROM maquina';

        $result = $this->maquina->query($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verMaquinasPorCliente (
        int $id_cliente_fk
    ) {
        $sql = 'SELECT * FROM maquina WHERE id_cliente_fk = :id_cliente_fk';

        $stmt = $this->maquina->prepare($sql);

        return $stmt->execute([
            ':id_cliente_fk' => $id_cliente_fk
        ]);
    }
}

?>