<?php

require_once __DIR__ . '/../Model/Pecas.php';

use Model\Pecas;


// ==========================================
// FETCH / AJAX
// ==========================================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    header('Content-Type: application/json');

    try {

        $dados = json_decode(
            file_get_contents("php://input"),
            true
        );

        if (!$dados) {

            echo json_encode([
                'sucesso' => false,
                'mensagem' => 'Dados inválidos'
            ]);

            exit;
        }

        $id = (int) $dados['id'];

        $status = $dados['status'];

        $pecas = new Pecas();

        $resultado =
            $pecas->atualizarStatus(
                $id,
                $status
            );

        echo json_encode([
            'sucesso' => $resultado
        ]);

    } catch (Exception $e) {

        echo json_encode([
            'sucesso' => false,
            'erro' => $e->getMessage()
        ]);

    }

    exit;
}


// ==========================================
// CARREGAR VIEW NORMAL
// ==========================================

$pecas = new Pecas();

$pesquisa =
    isset($_GET['busca'])
    ? $_GET['busca']
    : null;

$lista =
    $pecas->listarSolicitacoes($pesquisa);


// CAMINHO DA VIEW
require_once __DIR__ . '/../View/pagina_gerenciamento_de_pecas_administrador.php';