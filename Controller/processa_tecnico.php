<?php
require_once __DIR__ . '/GerenciamentoTecController.php';
use Controller\GerenciamentoTecController;

$controller = new GerenciamentoTecController();

// Ação de Excluir (via GET)
if (isset($_GET['acao']) && $_GET['acao'] === 'excluir') {
    $controller->excluirTecnico($_GET['id_tecnico']);
}

// Ação de Cadastrar/Editar (via POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $funcao = $_POST['funcao'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $id = $_POST['id_tecnico'] ?? null;

    if ($acao === 'cadastrar') {
        $controller->gerenciamentoTec->createTec($nome, $cpf, $funcao, $email, $senha);
    } elseif ($acao === 'editar') {
        // Você precisa desse método no GerenciamentoTec.php (Model)
        $controller->gerenciamentoTec->updateTec($id, $nome, $cpf, $funcao, $email);
    }
    header("Location: ../View/pagina_gerenciamento_de_tecnicos_adm.php");
    exit;
}
?>