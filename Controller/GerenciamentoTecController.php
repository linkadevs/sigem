<?php

/* =========================================================
   IMPORTA O MODEL
========================================================= */

require_once '../Model/GerenciamentoTec.php';

use Model\GerenciamentoTec;

/* =========================================================
   INSTÂNCIA DO MODEL
========================================================= */

$model = new GerenciamentoTec();

/* =========================================================
   RECEBE A AÇÃO
========================================================= */

$acao = $_POST['acao'] ?? $_GET['acao'] ?? '';

/* =========================================================
   EXCLUIR TÉCNICO
========================================================= */

if ($acao === 'excluir') {

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$id) {

        header("Location: ../View/pagina_gerenciamento_de_tecnicos_adm.php?erro=idinvalido");
        exit;
    }

    $resultado = $model->deleteTec($id);

    if ($resultado) {

        header("Location: ../View/pagina_gerenciamento_de_tecnicos_adm.php?sucesso=excluido");

    } else {

        header("Location: ../View/pagina_gerenciamento_de_tecnicos_adm.php?erro=delete");
    }

    exit;
}

/* =========================================================
   CADASTRAR TÉCNICO
========================================================= */

if ($acao === 'cadastrar') {

    $nome = trim($_POST['nome'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $funcao = trim($_POST['funcao'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (
        empty($nome) ||
        empty($cpf) ||
        empty($funcao) ||
        empty($email) ||
        empty($senha)
    ) {

        header("Location: ../View/pagina_cadastro_tecnico.php?erro=camposvazios");
        exit;
    }

    /* =========================
       VERIFICA EMAIL DUPLICADO
    ========================= */

    $emailExistente = $model->getTecByEmail($email);

    if ($emailExistente) {

        header("Location: ../View/pagina_cadastro_tecnico.php?erro=emailexistente");
        exit;
    }

    $resultado = $model->createTec(
        $nome,
        $cpf,
        $funcao,
        $email,
        $senha
    );

    if ($resultado) {

        header("Location: ../View/pagina_gerenciamento_de_tecnicos_adm.php?sucesso=cadastrado");

    } else {

        header("Location: ../View/pagina_cadastro_tecnico.php?erro=cadastro");
    }

    exit;
}

/* =========================================================
   EDITAR TÉCNICO
========================================================= */

if ($acao === 'editar') {

    $id_tecnico = filter_input(INPUT_POST, 'id_tecnico', FILTER_VALIDATE_INT);

    $nome = trim($_POST['nome'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $funcao = trim($_POST['funcao'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (
        !$id_tecnico ||
        empty($nome) ||
        empty($cpf) ||
        empty($funcao) ||
        empty($email)
    ) {

        header("Location: ../View/pagina_cadastro_tecnico.php?erro=camposinvalidos");
        exit;
    }

    $resultado = $model->updateTec(
        $id_tecnico,
        $nome,
        $cpf,
        $funcao,
        $email,
        $senha
    );

    if ($resultado) {

        header("Location: ../View/pagina_gerenciamento_de_tecnicos_adm.php?sucesso=editado");

    } else {

        header("Location: ../View/pagina_cadastro_tecnico.php?erro=update");
    }

    exit;
}

/* =========================================================
   BUSCAR POR ID
========================================================= */

if ($acao === 'buscarPorId') {

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!$id) {

        echo json_encode([
            'sucesso' => false,
            'mensagem' => 'ID inválido'
        ]);

        exit;
    }

    $tecnico = $model->getTecById($id);

    echo json_encode($tecnico);

    exit;
}

/* =========================================================
   BUSCAR POR EMAIL
========================================================= */

if ($acao === 'buscarPorEmail') {

    $email = trim($_GET['email'] ?? '');

    if (empty($email)) {

        echo json_encode([
            'sucesso' => false,
            'mensagem' => 'Email inválido'
        ]);

        exit;
    }

    $tecnico = $model->getTecByEmail($email);

    echo json_encode($tecnico);

    exit;
}

/* =========================================================
   BUSCAR POR FUNÇÃO
========================================================= */

if ($acao === 'buscarPorFuncao') {

    $funcao = trim($_GET['funcao'] ?? '');

    if (empty($funcao)) {

        echo json_encode([
            'sucesso' => false,
            'mensagem' => 'Função inválida'
        ]);

        exit;
    }

    $tecnicos = $model->getTecByFuncao($funcao);

    echo json_encode($tecnicos);

    exit;
}

/* =========================================================
   LISTAR TODOS
========================================================= */

if ($acao === 'listarTodos') {

    $todosTecnicos = $model->getAllTecs();

    echo json_encode($todosTecnicos);

    exit;
}

/* =========================================================
   PESQUISA
========================================================= */

$busca = trim($_GET['busca'] ?? '');

$todosTecnicos = $model->getAllTecs();

if (!empty($busca)) {

    $todosTecnicos = array_filter(
        $todosTecnicos,
        function ($tec) use ($busca) {

            return
                stripos($tec['nome'], $busca) !== false ||
                stripos($tec['cpf'], $busca) !== false ||
                stripos($tec['funcao'], $busca) !== false ||
                stripos($tec['email'], $busca) !== false;
        }
    );
}

/* =========================================================
   ENVIA PARA A VIEW
========================================================= */

require_once '../View/pagina_gerenciamento_de_tecnicos_adm.php';

?>