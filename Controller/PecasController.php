<?php

namespace Controller;

use Model\Pecas;
use Exception;

// Importa model
require_once __DIR__ . "/../Model/Pecas.php";

try {

    $pecas = new Pecas();


    // verifica se existe busca
    $pesquisa = null;

    if (isset($_GET['busca'])) {

        $pesquisa =
            trim($_GET['busca']);

    }


    // chama model
    $listaSolicitacoes =
        $pecas->listarSolicitacoes($pesquisa);


    // envia para view
    require_once '../../public/pagina_gerenciamento_de_pecas_administrador.php';

} catch (Exception $e) {

    echo $e->getMessage();

}

header('Content-Type: application/json');

try {

    // pega JSON enviado pelo fetch
    $dados =
        json_decode(
            file_get_contents('php://input'),
            true
        );


    // valida dados
    if (
        !isset($dados['id']) ||
        !isset($dados['status'])
    ) {

        echo json_encode([

            'sucesso' => false,
            'mensagem' => 'Dados inválidos'

        ]);

        exit;

    }


    $id =
        (int) $dados['id'];

    $status =
        $dados['status'];


    // cria model
    $pecas = new Pecas();


    // executa update
    $resultado =
        $pecas->atualizarStatus(
            $id,
            $status
        );


    // resposta pro JS
    echo json_encode([

        'sucesso' => $resultado

    ]);

} catch (Exception $e) {

    echo json_encode([

        'sucesso' => false,

        'mensagem' => $e->getMessage()

    ]);

}


?>