<?php
session_start();

$id_usuario = $_SESSION['id_usuario'];
require_once __DIR__ . '/../Controller/TecnicoController.php';
require_once __DIR__ . '/../Controller/GerenciamentoTecController.php';
require_once __DIR__ . '/../vendor/autoload.php';

$tecnicoController = new \Controller\TecnicoController();
$gerenciamentoTecController = new \Controller\GerenciamentoTecController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tecnicoController->updatePassword(
            $id_usuario,
            $_POST['password'] ?? null,
            $_POST['repeatPassword'] ?? null
        );
    }

$usuario = $gerenciamentoTecController->buscarTecnicoPorId($id_usuario);



$nome = $usuario['nome'];
$cpf = $usuario['cpf'];
$funcao = $usuario['funcao'];
$email = $usuario['email'];

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
                    <p class="rotulo">CPF</p>
                    <p class="valor"><?php echo htmlspecialchars($cpf ?? '', ENT_QUOTES, 'UTF-8');?></p>
                </div>
                
                <div class="linha_info">
                    <p class="rotulo">Função</p>
                    <p class="valor"><?php echo htmlspecialchars($funcao ?? '', ENT_QUOTES, 'UTF-8');?></p>
                </div>

                <div class="linha_info">
                    <p class="rotulo">E-mail</p>
                    <p class="valor"><?php echo htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8');?></p>
                </div>
            <form method="POST">
                <div class="secao_senha">
                    <p class="rotulo_senha">Alterar senha</p>
        
                    <div class="inputs_senha">
                        <input name="password" type="password" placeholder="Digite a nova senha">
                        <input name="repeatPassword" type="password" placeholder="Repita a nova senha">
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