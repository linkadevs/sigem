<?php
require_once __DIR__ . '/GerenciamentoClienteController.php';
use Controller\GerenciamentoClienteController;

$controller = new GerenciamentoClienteController();

if (isset($_GET['acao']) && $_GET['acao'] === 'excluir') {
    $controller->excluirCliente($_GET['id_cliente']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';
    if ($acao === 'cadastrar') {
        $controller->GerenciamentoCliente->createCliente($_POST['nome'], $_POST['cnpj'], $_POST['uf'], $_POST['cidade'], $_POST['contato'], $_POST['email'], $_POST['senha']);
    } elseif ($acao === 'editar') {
        $controller->GerenciamentoCliente->updateCliente($_POST['id_cliente'], $_POST['nome'], $_POST['cnpj'], $_POST['uf'], $_POST['cidade'], $_POST['contato'], $_POST['email']);
    }
    header("Location: ../View/pagina_gerenciamento_clientes.php");
    exit;
}