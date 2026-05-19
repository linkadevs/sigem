<?php
session_start();
require_once __DIR__ . '/../Controller/AdmController.php';
require_once __DIR__ . '/../Model/Adm.php';
require_once __DIR__ . '/../vendor/autoload.php';

$admModel = new \Model\Administrador();
$admController = new \Controller\AdmController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'update_profile') {
        $admController->updateAdm(
            $_SESSION['id_adm'],
            $_POST['nome'] ?? null,
            $_POST['email'] ?? null,
            $_POST['cpf'] ?? null,
        );
    }

    if (isset($_POST['action']) && $_POST['action'] === 'update_password') {
        $admController->updatePassword(
            $_SESSION['id_adm'],
            $_POST['nova_senha'] ?? null,
            $_POST['confirmar_senha'] ?? null
        );
    }
}
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

            <form method="POST">
            <div class="grade_informacoes">
            <input type="hidden" name="action" value="update_profile">

                    <div class="linha_info">
                        <p class="rotulo">Nome</p>
                        <!-- <p class="valor">UNEB</p> -->
                        <input type="text" class="valor" value="<?php echo htmlspecialchars($_SESSION['nome_adm'] ?? '', ENT_QUOTES, 'UTF-8');?>">
                    </div>
                    
                    <div class="linha_info">
                        <p class="rotulo">CNPJ</p>
                        <!-- <p class="valor">AB.123.CDE/0001-XY</p> -->
                        <input type="text" class="valor" value="<?php echo htmlspecialchars($_SESSION['cnpj_adm'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                    
                    <div class="linha_info">
                        <p class="rotulo">E-mail</p>
                        <!-- <p class="valor">abcdef.ghi@gmail.com</p> -->
                        <input type="text" class="valor" value="<?php echo htmlspecialchars($_SESSION['email_adm'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                    
                    <div class="linha_info" id="linha_senha">
                        <p class="rotulo">Senha</p>
                        <div class="senha">
                            <p class="valor" id="senha_desbloqueada" style="display: none;"><?php echo htmlspecialchars($_SESSION['senha'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="valor" id="senha_bloqueada">*****</p>
                            
                            
                            
                            <figure class="mostrar_senha">
                                <img src="../templates/assets/img/olhoaberto.png" id="olhoaberto" style="cursor: pointer; width: 3rem; height: 3rem;">
                                <img src="../templates/assets/img/olhofechado.png" id="olhofechado" alt="" style="cursor: pointer; display: none; width: 3rem; height: 3rem;">
                            </figure>
                        </div>
                        
                        
                        
                    </div>
                </div>
                
                <div class="secao_senha">
                    <p class="rotulo_senha">Alterar senha</p>
                    <div class="inputs_senha">
                        <input type="password" name="password" placeholder="Digite a nova senha">
                        <input type="password" name="password" placeholder="Repita a nova senha">
                    </div>
                </div>
                
                <div class="botoes_acao">
                    <button class="btn_cancelar">Cancelar</button>
                    <button class="btn_salvar" type="submit">Salvar</button>
                </div>
            </form>
        </section>
    </main>

    <script src="/templates/assets/js/perfil_do_cliente.js"></script>
</body>
</html>