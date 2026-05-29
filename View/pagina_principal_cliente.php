<?php 

session_start();

if((empty($_SESSION['id_usuario']) || !isset($_SESSION['id_usuario'])) && (empty($_GET['id_cliente']) || !isset($_GET['id_cliente']))) {
    header('Location: ../index.php');
} else {
    if(empty($_SESSION['id_usuario']) || !isset($_SESSION['id_usuario'])) {
        $_SESSION['id_usuario'] = $_GET['id_cliente'];
    }
}
$_SESSION['cod_maquina'] = null;
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../templates/assets/css/pagina_principal_cliente.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal do Cliente</title>
</head>

<body>
    <header>
        <div class="botoesHeader">
            <div class="logoutDiv">
                <figure class="logout">
                    <img src="../templates/assets/img/menu-logout.png" alt=" icone de logout">
                </figure>
                <p>Logout</p>
            </div>
            <button class="perfilBtn">
                <figure class="perfil_tec">
                    <img src="../templates/assets/img/perfiltec.png" alt=" icone de Perfil do Tecnico">
                </figure>
                <p>Perfil</p>
            </button>
        </div>


        <figure class="logo">
            <img src="../templates/assets/img/logo.png" alt=" icone da logo da empresa">
        </figure>
    </header>

    <main>
        <figure class="fundo_clientes">
            <img src="../templates/assets/img/fundo_clientes.png" alt="">
        </figure>
        <div class="texto_e_fotohomem">

            <div class="decoracao_consulta">

                <h1>Acompanhe os seus chamados em andamento</h1>
                <button class="consultarBtn" type="button" onclick="window.location.href='pagina_acompanhamento_chamados_cliente.php' "
                   >Consultar
                </button>
                <button class="maquinasBtn" type="button" onclick="window.location.href='gerenciamento_de_maquinas_clientes.php' "
                >Minhas máquinas
                </button>
            </div>
            <figure class="decoracao_seta">
                <img src="../templates/assets/img/decoracao.png" alt=" decoração de setas para baixo">
            </figure>
        </div>



        <div class="containertextos_e_dicas">
            <div class="padding">
                <h3>Dicas Importantes</h3>
            </div>
            <div class="caixas">
                <div class="caixa_roxa">
                    <div class="dica">
                        <figure class="raio_dec">
                            <img src="../templates/assets/img/raio.png" alt=" icone de raio">
                        </figure>
                        <p>O chamado será atendido em até 48 horas</p>
                    </div>
    
                    <div class="dica">
                        <figure class="raio_dec">
                            <img src="../templates/assets/img/raio.png" alt=" icone de raio">
                        </figure>
                        <p>Acompanhe o status do chamado</p>
                    </div>
    
                    <div class="dica">
                        <figure class="raio_dec">
                            <img src="../templates/assets/img/raio.png" alt=" icone de raio">
                        </figure>
                        <p>Para mais informações, acesse o histórico de manuntenções</p>
                    </div>
    
                </div>
    
                <div class="texto">
                    <h2>O primeiro passo foi seu. O próximo a <span>StarTech</span> te mostra!</h2>
                </div>
            </div>

        </div>

        <div class="containertextos_e_dicas2">
            <h2>O primeiro passo foi seu. O próximo a <span>StarTech</span> te mostra!</h2>
            <h3>Dicas Importantes</h3>
            <div class="caixa_roxa">
                    <div class="dica">
                        <figure class="raio_dec">
                            <img src="../templates/assets/img/raio.png" alt=" icone de raio">
                        </figure>
                        <p>O chamado será atendido em até 48 horas</p>
                    </div>
    
                    <div class="dica">
                        <figure class="raio_dec">
                            <img src="../templates/assets/img/raio.png" alt=" icone de raio">
                        </figure>
                        <p>Acompanhe o status do chamado</p>
                    </div>
    
                    <div class="dica">
                        <figure class="raio_dec">
                            <img src="../templates/assets/img/raio.png" alt=" icone de raio">
                        </figure>
                        <p>Para mais informações, acesse o histórico de manuntenções</p>
                    </div>
    
                </div>
        </div>

    </main>
    <script src="../templates/assets/js/pagina_principal_cliente.js"></script>

</body>

</html>