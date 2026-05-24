<?php
require_once __DIR__ . '/GerenciamentoTecController.php';
use Controller\GerenciamentoTecController;

$controller = new GerenciamentoTecController();

// Ação de Excluir (via GET)
if (isset($_GET['acao']) && $_GET['acao'] === 'excluir') {
    $id_tecnico = $_GET['id_tecnico'] ?? null;
    $controller->excluirTecnico($id_tecnico);
    header("Location: ../View/pagina_gerenciamento_de_tecnicos_adm.php");
    exit;
}

// Ação de Cadastrar/Editar (via POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = trim($_POST['acao'] ?? '');
    $nome = trim($_POST['nome'] ?? '');
    $cpf = trim($_POST['cpf'] ?? '');
    $funcao = trim($_POST['funcao'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $id = $_POST['id_tecnico'] ?? null;

    if ($acao === 'cadastrar') {
        $controller->criarTecnico($nome, $cpf, $funcao, $email, $senha);
        echo "<script>
                alert('Técnico cadastrado com sucesso.')
                window.location.href = '../View/pagina_gerenciamento_de_tecnicos_adm.php';
            </script>";
    } elseif ($acao === 'editar') {
        $controller->atualizarTecnico($id, $nome, $cpf, $funcao, $email, $senha);
        echo "<script>
                alert('Técnico atualizado com sucesso.')
                window.location.href = '../View/pagina_gerenciamento_de_tecnicos_adm.php';
            </script>";
    }
    exit;
}
?>