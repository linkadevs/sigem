<?php
session_start();
require_once __DIR__ . '/../Controller/AdmController.php';
require_once __DIR__ . '/../vendor/autoload.php';


$admController = new \Controller\AdmController();
$administrador = $admController->selecionarAdmPorId($_SESSION['id_administrador']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_SESSION['id_administrador'];

    if (
        !empty($_POST['nome']) ||
        !empty($_POST['cpf']) ||
        !empty($_POST['email'])
    ) {
        $cpf = preg_replace('/\D/', '', $_POST['cpf']);
        $admController->updateAdm(
            $_POST['nome'],
            $cpf,
            $_POST['email'],
            $id
        );
    }

    if (
        !empty($_POST['nova_senha']) ||
        !empty($_POST['confirmar_senha'])
    ) {
        $_SESSION['error_message'] = '';
        $admController->updatePassword(
            $id,
            $_POST['nova_senha'],
            $_POST['confirmar_senha']
        );
    }

    header('Location: perfil_do_adm.php');
    exit;
}

if(isset($_SESSION['success_message'])) {
    echo '<script>alert("Perfil/senha alterado com sucesso")</script>';
    $_SESSION['success_message'] = null;
}

if(isset($_GET['error_message'])) {
    echo '<script>
        alert("'.$_GET['error_message'].'")
        window.location.href = "perfil_do_adm.php"
    </script>';
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

            <form method="POST">
            <div class="grade_informacoes">
            <input type="hidden" name="action" value="update_profile">

                    <div class="linha_info">
                        <p class="rotulo">Nome</p>
                        <!-- <p class="valor">UNEB</p> -->
                        <input type="text" name="nome" class="valor" placeholder="<?php echo htmlspecialchars($administrador['nome'] ?? '', ENT_QUOTES, 'UTF-8');?>">
                    </div>
                    
                    <div class="linha_info">
                        <p class="rotulo">CPF</p>
                        <!-- <p class="valor">AB.123.CDE/0001-XY</p> -->
                        <input type="text" name="cpf" class="valor" placeholder="<?php echo htmlspecialchars($administrador['cpf'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                    
                    <div class="linha_info">
                        <p class="rotulo">E-mail</p>
                        <!-- <p class="valor">abcdef.ghi@gmail.com</p> -->
                        <input type="text" name="email" class="valor" placeholder="<?php echo htmlspecialchars($administrador['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                    
                    <div class="linha_info" id="linha_senha">
                        <p class="rotulo">Senha</p>
                        <p class="valor" id="senha_bloqueada"><?= str_repeat('*', $administrador['qtd_caracteres'])?></p>
                    </div>
                </div>
                
                <div class="secao_senha">
                    <p class="rotulo_senha">Alterar senha</p>
                    <div class="inputs_senha">
                        <input type="password" name="nova_senha" placeholder="Digite a nova senha">
                        <input type="password" name="confirmar_senha" placeholder="Repita a nova senha">
                    </div>
                    <?php if(isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])):?>
                        <p class="erro"><?= $_SESSION['error_message']?></p>
                        <?php $_SESSION['error_message'] = '';?>
                    <?php endif;?>
                </div>
                
                <div class="botoes_acao">
                    <button class="btn_cancelar" type="button">Cancelar</button>
                    <button class="btn_salvar" type="submit">Salvar</button>
                </div>
            </form>
        </section>
    </main>

    <script src="../templates/assets/js/perfil_do_adm.js"></script>
</body>
</html>