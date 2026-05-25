<?php
// Avisar a Fred para adicionar no dele
session_start();

$objetivo = $_GET['objetivo'] ?? null;
$cod_maquina = $_GET['cod_maquina'] ?? null;

if ($cod_maquina) {
    $_SESSION['cod_maquina'] = $cod_maquina;
}
if ($objetivo) {
    $_SESSION['objetivo'] = $objetivo;
}

$erro = $_SESSION['erro'] ?? null;
unset($_SESSION['erro']);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../templates/assets/css/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
</head>

<body>
    <main>
        <div class="container">
            <div class="imagem_de_fundo">
            </div>

            <div class="Cform_login">

                <figure>
                    <img src=" ../templates/assets/img/seta_voltar.png" alt="seta azul">
                </figure>

                <h1>Login</h1>
                <h2>Realize o login para identificarmos você!</h2>

                <figure>
                    <img src=" ../templates/assets/img/linha_azul.png" alt="linha azul no form">
                </figure>

                    <!-- Avisar a Fred para adicionar no dele até a parte do form também, 
                     eu vou chamar o controller de validação do
                      login dentro do meu arquivo chamado processa_login para segmentar o 
                      acesso a abertura de chamados, histórico e tal
                      , então deixa o action assim -->

                <?php if ($erro): ?>
                    <div class="mensagem-erro" style="color: red; text-align: center; margin: 10px 0; font-size: 1.2rem;">
                        <?php echo htmlspecialchars($erro); ?>
                    </div>
                <?php endif; ?>
                    
                <form class=form_ method="POST" action="processa_login.php">

                    <!-- Avisar a Fred para adicionar no dele -->
                    <input type="hidden" name="objetivo" value="<?php echo htmlspecialchars($objetivo ?? '');?>">
                    <input type="hidden" name="cod_maquina" value="<?php echo htmlspecialchars($cod_maquina ?? '');?>">


                    <!-- Prestar atenção no nome dos inputs -->

                    <div class="input_cpf">
                        <label for="Cpf">CPF/CNPJ</label>
                        <input type="text" id="Cpf" name="cpf_cnpj" placeholder="000.000.000-00" required>
                    </div>

                    <div class="input_senha">
                        <label for="Senha">Senha</label>
                        <input type="password" id="Senha" name="senha" placeholder="Digite aqui a sua senha" required>

                        <figure class="olho1">
                            <img src="../templates/assets/img/olho_fechado.png"
                                alt="Imagem de um olho para ocultar a senha">
                        </figure>

                        <figure class="olho2">
                            <img src="../templates/assets/img/olho_aberto.png"
                                alt="Imagem de um olho para mostrar a senha">
                        </figure>
                    </div>

                    <div class="btn_login">
                        <button type="submit">Entrar</button>
                    </div>
                </form>
            </div>
    </main>
</body>

</html>