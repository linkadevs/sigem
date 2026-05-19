<?php
session_start();
require_once __DIR__ . '/../Controller/ClienteController.php';
require_once __DIR__ . '/../Model/Cliente.php';
require_once __DIR__ . '/../vendor/autoload.php';

$admModel = new \Model\Cliente();
$admController = new \Controller\ClienteController();

    if (isset($_POST['action']) && $_POST['action'] === 'update_password') {
        $admController->updatePassword(
            $_SESSION['id_cliente'],
            $_POST['nova_senha'] ?? null,
            $_POST['confirmar_senha'] ?? null
        );
    }

$_SESSION['tipo_usuario'] = 'cliente';
$_SESSION['id_usuario'] = 1;
$_SESSION['nome_usuario'] = 'Pedro';
$_SESSION['cpf'] = '12345678900';
$_SESSION['uf'] = 'ba';
$_SESSION['cidade'] = 'Salvador';
$_SESSION['contato'] = '71984358900';
$_SESSION['email'] = 'teste@teste.com';
$_SESSION['cnpj'] = '123.456.789/0001-0';

$tipo_tecnico = $_SESSION['tipo_usuario'];
$id_tecnico = $_SESSION['id_usuario'];
$nome = $_SESSION['nome_usuario'];
$cpf = $_SESSION['cpf'];
$uf = $_SESSION['uf'];
$cidade = $_SESSION['cidade'];
$contato = $_SESSION['contato'];
$email = $_SESSION['email'];
$cnpj = $_SESSION['cnpj'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Perfil</title>
    <link rel="stylesheet" href="/templates/assets/css/perfil_do_cliente.css">
</head>
<body>

    <header class="cabecalho_perfil">
        <button class="btn_voltar">
            <figure><img src="/templates/assets/img/seta_voltar.png" alt="Seta Voltar"></figure>
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
                    <p class="rotulo">Acompanhante</p>
                    <p class="valor"><?php echo htmlspecialchars($nome ?? '', ENT_QUOTES, 'UTF-8');?></p>
                </div>

                <div class="linha_info">
                    <p class="rotulo">CPF</p>
                    <p class="valor"><?php echo htmlspecialchars($cpf ?? '', ENT_QUOTES, 'UTF-8');?></p>
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

            <div class="secao_senha">
                <p class="rotulo_senha">Alterar senha</p>
                <div class="inputs_senha">
                    <input type="password" placeholder="Digite a nova senha">
                    <input type="password" placeholder="Repita a nova senha">
                </div>
            </div>

            <div class="botoes_acao">
                <button class="btn_cancelar">Cancelar</button>
                <button class="btn_salvar">Salvar</button>
            </div>
        </section>
    </main>

    <script src="/templates/assets/js/perfil_do_cliente.js"></script>
</body>
</html>