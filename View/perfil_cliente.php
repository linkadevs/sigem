<?php
session_start();

$id_cliente = $_SESSION['id_usuario'];

use Model\Cliente;
use Controller\ClienteController;
use Controller\GerenciamentoClienteController;

require_once __DIR__ . '/../Controller/ClienteController.php';
require_once __DIR__ . '/../Model/Cliente.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Controller/GerenciamentoClienteController.php';


$clienteModel = new Cliente();
$clienteController = new ClienteController();
$gerenciamentoClienteController = new GerenciamentoClienteController();

$cliente = $gerenciamentoClienteController->buscarClientePorId($id_cliente);

$nome = $cliente['nome'];
$cnpj = $cliente['cnpj'];
$uf = $cliente['uf'];
$cidade = $cliente['cidade'];
$contato = $cliente['contato'];
$email = $cliente['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clienteController->updatePassword(
        $id_cliente,
        $_POST['nova_senha'] ?? null,
        $_POST['confirmar_senha'] ?? null
    );
    header('Location: perfil_cliente.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Perfil</title>
    <link rel="stylesheet" href="../templates/assets/css/perfil_do_cliente.css">
</head>
<body>

    <header class="cabecalho_perfil">
        <button class="btn_voltar">
            <figure><img src="../templates/assets/img/seta_voltar.png" alt="Seta Voltar"></figure>
            <span>Voltar</span>
        </button>
        <h1 class="titulo_cabecalho">Seu perfil</h1>
        <div class="espacamento_fantasma"></div>
    </header>

    <main class="container_fundo">
        <section class="card_perfil">
            <h2 class="titulo_card">Informações pessoais</h2>

            <div class="grade_informacoes">
                <div class="linha_info">
                    <p class="rotulo">Nome</p>
                    <p class="valor"><?php echo htmlspecialchars($nome ?? '', ENT_QUOTES, 'UTF-8');?></p>
                </div>

                <div class="linha_info">
                    <p class="rotulo">CNPJ</p>
                    <p class="valor"><?php echo htmlspecialchars($cnpj ?? '', ENT_QUOTES, 'UTF-8');?></p>
                </div>
                
                <div class="linha_info">
                    <p class="rotulo">UF</p>
                    <p class="valor"><?php echo htmlspecialchars($uf ?? '', ENT_QUOTES, 'UTF-8');?></p>
                </div>

                <div class="linha_info">
                    <p class="rotulo">Cidade</p>
                    <p class="valor"><?php echo htmlspecialchars($cidade ?? '', ENT_QUOTES, 'UTF-8');?></p>
                </div>

                <div class="linha_info">
                    <p class="rotulo">Número de contato</p>
                    <p class="valor"><?php echo htmlspecialchars($contato ?? '', ENT_QUOTES, 'UTF-8');?></p>
                </div>

                <div class="linha_info">
                    <p class="rotulo">E-mail</p>
                    <p class="valor"><?php echo htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8');?></p>
                </div>
            <form method="POST">
                <div class="secao_senha">
                    <p class="rotulo_senha">Alterar senha</p>
                    <div class="inputs_senha">
                        <input type="password" name="nova_senha" placeholder="Digite a nova senha">
                        <input type="password" name="confirmar_senha" placeholder="Repita a nova senha">
                    </div>
                    <?php if(isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])):?>
                        <p class="erro"><?= $_SESSION['error_message']?></p>
                    <?php endif;?>
                </div>

                <div class="botoes_acao">
                    <button class="btn_cancelar">Cancelar</button>
                    <button class="btn_salvar" onclick="return confirm('Tem certeza que deseja mudar a senha?')">Salvar</button>
                </div>
            </form>
        </section>
    </main>

    <script src="../templates/assets/js/perfil_do_cliente.js"></script>
</body>
</html>