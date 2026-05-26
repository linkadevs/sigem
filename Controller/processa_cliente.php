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

        $nome = trim($_POST['nome'] ?? '');
        $cnpj = preg_replace('/\D/', '', $_POST['cnpj'] ?? '');
        $uf = trim($_POST['uf'] ?? '');
        $cidade = trim($_POST['cidade'] ?? '');
        $contato = preg_replace('/\D/', '', $_POST['contato'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if (
            empty($nome) ||
            empty($cnpj) ||
            empty($uf) ||
            empty($cidade) ||
            empty($contato) ||
            empty($email) ||
            empty($senha)
        ) {

            echo '<script>
                    alert("Por favor, preencha todos os campos.");
                    window.history.back();
                </script>';
            exit;
        }

        if (strlen($cnpj) !== 14) {
            echo '<script>
                    alert("O CNPJ deve conter exatamente 14 dígitos. (Insira apenas números)");
                    window.history.back();
                </script>';
            exit;
        }

        if (strlen($contato) !== 11) {
            echo '<script>
                    alert("O telefone deve conter exatamente 11 dígitos. (Insira apenas números)");
                    window.history.back();
                </script>';
            exit;
        }

        // FORMATA O CNPJ: 00.000.000/0000-00
        $cnpj = preg_replace(
            "/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/",
            "$1.$2.$3/$4-$5",
            $cnpj
        );

        // FORMATA O TELEFONE: (00) 00000-0000
        $contato = preg_replace(
            "/(\d{2})(\d{1})(\d{4})(\d{4})/",
            "($1) $2 $3-$4",
            $contato
        );

        $controller->criarCliente(
            $nome,
            $cnpj,
            $uf,
            $cidade,
            $contato,
            $email,
            $senha
        );

        echo '<script>
                alert("Cliente cadastrado com sucesso.")
                window.location.href = "../View/pagina_gerenciamento_clientes.php";
            </script>';
    }

    if ($acao === 'editar') {
        
        $nome = trim($_POST['nome'] ?? '');
        $cnpj = preg_replace('/\D/', '', $_POST['cnpj'] ?? '');
        $uf = trim($_POST['uf'] ?? '');
        $cidade = trim($_POST['cidade'] ?? '');
        $contato = preg_replace('/\D/', '', $_POST['contato'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        if (
            empty($nome) ||
            empty($cnpj) ||
            empty($uf) ||
            empty($cidade) ||
            empty($contato) ||
            empty($email) ||
            empty($senha)
        ) {

            echo '<script>
                    alert("Por favor, preencha todos os campos.");
                    window.history.back();
                </script>';
            exit;
        }

        if (strlen($cnpj) !== 14) {
            echo '<script>
                    alert("O CNPJ deve conter exatamente 14 dígitos. (Insira apenas números)");
                    window.history.back();
                </script>';
            exit;
        }

        if (strlen($contato) !== 11) {
            echo '<script>
                    alert("O telefone deve conter exatamente 11 dígitos. (Insira apenas números)");
                    window.history.back();
                </script>';
            exit;
        }

        // FORMATA O CNPJ: 00.000.000/0000-00
        $cnpj = preg_replace(
            "/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/",
            "$1.$2.$3/$4-$5",
            $cnpj
        );

        // FORMATA O TELEFONE: (00) 00000-0000
        $contato = preg_replace(
            "/(\d{2})(\d{1})(\d{5})(\d{4})/",
            "($1) $2 $3-$4",
            $contato
        );

        $controller->atualizarCliente(
            $_POST['id_cliente'] ?? null,
            $nome,
            $cnpj,
            $uf,
            $cidade,
            $contato,
            $email,
            $senha
        );
        echo '<script>
                alert("Cliente atualizado com sucesso.")
                window.location.href = "../View/pagina_gerenciamento_clientes.php";
            </script>';
    }
    exit;
}