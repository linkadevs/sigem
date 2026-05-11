<?php

namespace Model;

use Model\Connection;
use PDO;
use PDOException;

// Importa a Connection
require_once __DIR__ . '/Connection.php';

class Pecas {
    private $pecas;

    public function __construct() {
        $this->pecas = Connection::getInstance();
    }

   // Adição dos parâmetros que a função precisa receber para funcionar
    public function vincSolicitacao($nome_peca, $descricao, $status, $id_tecnico_fk) {
    try {
        $sql = 'INSERT INTO solicitacao_pecas (nome_peca, data, descricao, status, id_tecnico_fk) 
                VALUES (:nome_peca, NOW(), :descricao, :status, :id_tecnico_fk)';

        $stmt = $this->pecas->prepare($sql);

        // Vinculação de parâmetros 
        $stmt->bindParam(':nome_peca', $nome_peca, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        
        // Enum no banco é tratado como String (STR) no PDO
        $stmt->bindParam(':status', $status, PDO::PARAM_STR); 
        
        $stmt->bindParam(':id_tecnico_fk', $id_tecnico_fk, PDO::PARAM_INT);

        return $stmt->execute();

    } catch (PDOException $e) {
        // mensagem real do erro para facilitar o debug
        throw new \Exception('Erro no banco de dados: ' . $e->getMessage());
    }
}

public function listarSolicitacoes($pesquisa = null) {
    try {
        // Se houver pesquisa, adicionamos o WHERE, se não, pegamos tudo
        if ($pesquisa) {
            $sql = "SELECT * FROM solicitacao_pecas 
                    WHERE nome_peca LIKE :busca 
                    OR descricao LIKE :busca 
                    OR status LIKE :busca 
                    ORDER BY data DESC";
            $stmt = $this->pecas->prepare($sql);
            
            // O '%' serve para achar a palavra em qualquer lugar (antes ou depois)
            $termo = "%$pesquisa%"; 
            $stmt->bindParam(':busca', $termo, PDO::PARAM_STR);
        } else {
            // Caso contrário, apenas seleciona tudo
            $sql = "SELECT * FROM solicitacao_pecas ORDER BY data DESC";
            $stmt = $this->pecas->prepare($sql);
        }

        $stmt->execute();
        
        // fetchAll(PDO::FETCH_ASSOC) é o que "puxa" os dados e monta a array $lista
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        throw new \Exception("Erro ao buscar dados: " . $e->getMessage());
    }
}


public function atualizarStatus(
    int $id,
    string $status
) {

    try {

        $sql = '
            UPDATE solicitacao_pecas

            SET status = :status

            WHERE id_solicitacao_pecas = :id
        ';


        $stmt = $this->pecas->prepare($sql);


        $stmt->bindParam(
            ':status',
            $status,
            PDO::PARAM_STR
        );

        $stmt->bindParam(
            ':id',
            $id,
            PDO::PARAM_INT
        );


        return $stmt->execute();

    } catch (PDOException $e) {

        throw new \Exception(
            'Erro ao atualizar status: ' .
            $e->getMessage()
        );

    }

}
}

    
?>

