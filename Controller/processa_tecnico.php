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
    $cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
    $funcao = trim($_POST['funcao'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $id = $_POST['id_tecnico'] ?? null;

    if ($acao === 'cadastrar') {

        if (
            empty($nome) ||
            empty($cpf) ||
            empty($funcao) ||
            empty($email) ||
            empty($senha)
        ) {

            echo '<script>
                    alert("Por favor, preencha todos os campos.");
                    window.history.back();
                </script>';
            exit;
        }

        if (strlen($cpf) !== 11) {
            echo '<script>
                    alert("O CPF deve conter exatamente 11 dígitos. (Insira apenas números)");
                    window.history.back();
                </script>';
            exit;
        }

        // FORMATA O CPF 000.000.000-00
        $cpf = preg_replace(
            "/(\d{3})(\d{3})(\d{3})(\d{2})/",
            "$1.$2.$3-$4",
            $cpf
        );

        $controller->criarTecnico($nome, $cpf, $funcao, $email, $senha);
        echo "<script>
                alert('Técnico cadastrado com sucesso.')
                window.location.href = '../View/pagina_gerenciamento_de_tecnicos_adm.php';
            </script>";
    }


    if ($acao === 'editar') {

        if (
            empty($nome) ||
            empty($cpf) ||
            empty($funcao) ||
            empty($email) ||
            empty($senha)
        ) {

            echo '<script>
                    alert("Por favor, preencha todos os campos.");
                    window.history.back();
                </script>';
            exit;
        }

        if (strlen($cpf) !== 11) {
            echo '<script>
                    alert("O CPF deve conter exatamente 11 dígitos. (Insira apenas números)");
                    window.history.back();
                </script>';
            exit;
        }

        // FORMATA O CPF 000.000.000-00
        $cpf = preg_replace(
            "/(\d{3})(\d{3})(\d{3})(\d{2})/",
            "$1.$2.$3-$4",
            $cpf
        );

        $controller->atualizarTecnico($id, $nome, $cpf, $funcao, $email, $senha);
        echo "<script>
                alert('Técnico atualizado com sucesso.')
                window.location.href = '../View/pagina_gerenciamento_de_tecnicos_adm.php';
            </script>";
    }
    exit;
}
?>