<?php

namespace Model;

use Model\Connection;
use PDO;
use PDOException;

// IMPORTA A CONNECTION
require_once __DIR__ . '/Connection.php';

class Pecas
{
    private $pecas;

    public function __construct()
    {
        $this->pecas = Connection::getInstance();
    }

    // LISTAR SOLICITAÇÕES
    public function getAllSolicitacoes()
    {
        try {

            $sql = "SELECT 
                        solicitacao_pecas.id_solicitacao_pecas,
                        solicitacao_pecas.nome_peca,
                        solicitacao_pecas.quantidade_pecas,
                        solicitacao_pecas.data,
                        solicitacao_pecas.descricao,
                        solicitacao_pecas.status,
                        solicitacao_pecas.id_tecnico_fk,

                        tecnico.nome AS nome_tecnico

                    FROM solicitacao_pecas

                    INNER JOIN tecnico
                    ON tecnico.id_tecnico =
                    solicitacao_pecas.id_tecnico_fk

                    ORDER BY solicitacao_pecas.data DESC";

            $stmt = $this->pecas->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            return [];
        }
    }

    // PESQUISAR SOLICITAÇÃO

    // PESQUISAR SOLICITAÇÃO
   
// PESQUISAR SOLICITAÇÃO
public function searchSolicitacao($busca)
{
    try {

        $sql = "SELECT 
                    solicitacao_pecas.id_solicitacao_pecas,
                    solicitacao_pecas.nome_peca,
                    solicitacao_pecas.quantidade_pecas,
                    solicitacao_pecas.data,
                    solicitacao_pecas.descricao,
                    solicitacao_pecas.status,
                    solicitacao_pecas.id_tecnico_fk,

                    tecnico.nome AS nome_tecnico

                FROM solicitacao_pecas

                INNER JOIN tecnico
                ON tecnico.id_tecnico =
                solicitacao_pecas.id_tecnico_fk

                WHERE
                    LOWER(solicitacao_pecas.nome_peca)
                    LIKE :nome_peca

                    OR CAST(
                        solicitacao_pecas.quantidade_pecas AS CHAR
                    ) LIKE :quantidade_pecas

                    OR LOWER(solicitacao_pecas.descricao)
                    LIKE :descricao

                    OR LOWER(tecnico.nome)
                    LIKE :tecnico_nome

                    OR REPLACE(
                        LOWER(solicitacao_pecas.status),
                        '_',
                        ' '
                    ) LIKE :status

                    OR DATE_FORMAT(
                        solicitacao_pecas.data,
                        '%d/%m/%Y'
                    ) LIKE :data_busca

                ORDER BY solicitacao_pecas.data DESC";

        $stmt = $this->pecas->prepare($sql);

        $busca = '%' . strtolower(trim($busca)) . '%';

        $stmt->bindValue(':nome_peca', $busca);
        $stmt->bindValue(':quantidade_pecas', $busca);
        $stmt->bindValue(':descricao', $busca);
        $stmt->bindValue(':tecnico_nome', $busca);
        $stmt->bindValue(':status', $busca);
        $stmt->bindValue(':data_busca', $busca);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {

        return [];
    }
}


    // BUSCAR POR ID
    public function getSolicitacaoById($id_solicitacao_pecas)
    {
        try {

            $sql = "SELECT * FROM solicitacao_pecas
                    WHERE id_solicitacao_pecas =
                    :id_solicitacao_pecas";

            $stmt = $this->pecas->prepare($sql);

            $stmt->bindParam(
                ':id_solicitacao_pecas',
                $id_solicitacao_pecas,
                PDO::PARAM_INT
            );

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            return null;
        }
    }

    // EXCLUIR SOLICITAÇÃO
    public function deleteSolicitacao($id_solicitacao_pecas)
    {
        try {

            $sql = "DELETE FROM solicitacao_pecas
                    WHERE id_solicitacao_pecas =
                    :id_solicitacao_pecas";

            $stmt = $this->pecas->prepare($sql);

            $stmt->bindParam(
                ':id_solicitacao_pecas',
                $id_solicitacao_pecas,
                PDO::PARAM_INT
            );

            return $stmt->execute();

        } catch (PDOException $e) {

            return false;
        }
    }

    // CONCLUIR SOLICITAÇÃO
    public function concluirSolicitacao($id_solicitacao_pecas)
    {
        try {

            $sql = "UPDATE solicitacao_pecas
                    SET status = 'concluido'

                    WHERE id_solicitacao_pecas =
                    :id_solicitacao_pecas";

            $stmt = $this->pecas->prepare($sql);

            $stmt->bindParam(
                ':id_solicitacao_pecas',
                $id_solicitacao_pecas,
                PDO::PARAM_INT
            );

            return $stmt->execute();

        } catch (PDOException $e) {

            return false;
        }
    }
}

?>