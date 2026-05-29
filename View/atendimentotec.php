<?php

session_start();

$id_tecnico = $_SESSION['id_usuario'];

use Controller\ChamadoController;

require_once __DIR__ . '/../Controller/ChamadoController.php';
require_once __DIR__ . '/../vendor/autoload.php';

$chamadoController = new ChamadoController();

if(isset($_GET['search']) && !empty($_GET['search'])) {
    $pesquisa = $_GET['search'];
    $chamados = $chamadoController->pesquisarChamadoTecnico(
        $pesquisa,
        $id_tecnico
    );
} else {
    $chamados = $chamadoController->selecionarChamadosPorTecnico($id_tecnico);
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['id_chamado'] = $_POST['id_chamado'];
    header('Location: detalhamento_de_chamados_tecnico.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../templates/assets/css/atendimentotec.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atendimento Técnico</title>
</head>

<body>
    <main>

        <!-- CONTEÚDO SUPERIOR -->
        <div class="conteudo_superior">
            <div class="topo">
                <button class="seta_voltar">
                    <img src="../templates/assets/img/seta_voltar_semfundo.png" alt="seta voltar">
                </button>

                <div class="direita">
                    <div class="perfil">
                        <img src="../templates/assets/img/perfil_tecnico.png" alt="Icone do perfil do técnico">
                        <span>Perfil</span>
                    </div>
                    <div class="logout">
                        <img src="../templates/assets/img/menu-logout.png" alt="Icone de logout">
                        <span>Logout</span>
                    </div>
                </div>
            </div>

            <h1>Chamados</h1>

            <form method="GET">
                <div class="input-container">
                    <img src="../templates/assets/img/lupa.png" alt="lupa de pesquisa">
                    <input type="text" id="pesquisa" name="search"
                        placeholder="Busque por um Cliente, UF, CNPJ ou Código da Máquina!" autocomplete="off">
                </div>
                <button type="submit" class="procurar">Procurar</button>
            </form>
        </div>

        <!-- GRID DE BLOCOS/CHAMADOS -->
        <div class="container_blocos">
            <?php foreach ($chamados as $chamado):?>
            <div class="bloco" id="<?= $chamado['id_chamado']?>">
                <div class="topo_bloco">
                    <h2><?= htmlspecialchars($chamado['nome_cliente'])?></h2>
                </div>
                <div class="conteudo_bloco">
                    <p class="titulo">Status</p>
                    <p class="status"><?php
                                switch ($chamado['status_chamado']) {
                                    case 'aberto':
                                        echo 'Aberto';
                                        break;
                                    
                                    case 'em_andamento':
                                        echo 'Em andamento';
                                        break;

                                    case 'resolvido':
                                        echo 'Resolvido';
                                        break;
                                } 
                            ?></p>

                    <p class="tecnico">Técnico responsável</p>
                    <p class="nome">
                        <?php if($chamado['nome_tecnico']):?>
                            <?= htmlspecialchars($chamado['nome_tecnico'])?>
                        <?php else:?>
                            <?= 'Nenhum técnico se responsabilizou por esse chamado ainda'?>
                        <?php endif;?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- <div class="bloco">
                <div class="topo_bloco">
                    <h2>UNEB</h2>
                </div>
                <div class="conteudo_bloco">
                    <p class="titulo">Status</p>
                    <p class="status">Em aberto</p>

                    <p class="tecnico">Técnico responsável</p>
                    <p class="nome">Nenhum técnico se responsabilizou por esse chamado ainda</p>
                </div>
            </div>

            <div class="bloco">
                <div class="topo_bloco">
                    <h2>UNEB</h2>
                </div>
                <div class="conteudo_bloco">
                    <p class="titulo">Status</p>
                    <p class="status">Em aberto</p>

                    <p class="tecnico">Técnico responsável</p>
                    <p class="nome">Nenhum técnico se responsabilizou por esse chamado ainda</p>
                </div>
            </div>

            <div class="bloco">
                <div class="topo_bloco">
                    <h2>UNEB</h2>
                </div>
                <div class="conteudo_bloco">
                    <p class="titulo">Status</p>
                    <p class="status">Em aberto</p>

                    <p class="tecnico">Técnico responsável</p>
                    <p class="nome">Nenhum técnico se responsabilizou por esse chamado ainda</p>
                </div>
            </div>

            <div class="bloco">
                <div class="topo_bloco">
                    <h2>UNEB</h2>
                </div>
                <div class="conteudo_bloco">
                    <p class="titulo">Status</p>
                    <p class="status">Em aberto</p>

                    <p class="tecnico">Técnico responsável</p>
                    <p class="nome">Nenhum técnico se responsabilizou por esse chamado ainda</p>
                </div>
            </div>

            <div class="bloco">
                <div class="topo_bloco">
                    <h2>UNEB</h2>
                </div>
                <div class="conteudo_bloco">
                    <p class="titulo">Status</p>
                    <p class="status">Em aberto</p>

                    <p class="tecnico">Técnico responsável</p>
                    <p class="nome">Nenhum técnico se responsabilizou por esse chamado ainda</p>
                </div>
            </div> -->

        </div>
    </main>

    <script src="../templates/assets/js/atendimentotec.js" defer></script>
</body>

</html>