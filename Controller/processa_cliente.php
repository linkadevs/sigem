<?php
require_once __DIR__ . '/GerenciamentoClienteController.php';
use Controller\GerenciamentoClienteController;

$controller = new GerenciamentoClienteController();

if (isset($_GET['acao']) && $_GET['acao'] === 'excluir') {
    $id_cliente = $_GET['id_cliente'] ?? null;
    $controller->excluirCliente($id_cliente);
    header("Location: ../View/pagina_gerenciamento_clientes.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = trim($_POST['acao'] ?? '');

    if ($acao === 'cadastrar') {
        $controller->criarCliente(
            trim($_POST['nome'] ?? ''),
            trim($_POST['cnpj'] ?? ''),
            trim($_POST['uf'] ?? ''),
            trim($_POST['cidade'] ?? ''),
            trim($_POST['contato'] ?? ''),
            trim($_POST['email'] ?? ''),
            $_POST['senha'] ?? ''
        );
        echo '<script>
                alert("Cliente cadastrado com sucesso.")
                window.location.href = "../View/pagina_gerenciamento_clientes.php";
            </script>';
    } 
    if ($acao === 'editar') {
        $controller->atualizarCliente(
            $_POST['id_cliente'] ?? null,
            trim($_POST['nome'] ?? ''),
            trim($_POST['cnpj'] ?? ''),
            trim($_POST['uf'] ?? ''),
            trim($_POST['cidade'] ?? ''),
            trim($_POST['contato'] ?? ''),
            trim($_POST['email'] ?? ''),
            trim($_POST['senha'] ?? '')
        );
        echo '<script>
                alert("Cliente atualizado com sucesso.")
                window.location.href = "../View/pagina_gerenciamento_clientes.php";
            </script>';
    }
    exit;
}