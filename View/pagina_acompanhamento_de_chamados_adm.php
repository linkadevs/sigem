<?php

use Controller\ChamadoController;
require_once __DIR__ . '/../Controller/ChamadoController.php';
require_once __DIR__ . '/../vendor/autoload.php';
$chamadoController = new ChamadoController();
if (!empty($_GET['search']) && isset($_GET['search'])) {
    $pesquisa = $_GET['search'];
    $chamados = $chamadoController->pesquisarChamado($pesquisa);
} else {
    $chamados = $chamadoController->selecionarTodosOsChamados();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../templates/assets/css/pagina_acompanhamento_de_chamados_adm..css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acompanhamento de chamados</title>
</head>

<body>
    <aside class="menu_lateral">
        <nav>
            <div class="menu_perfil">
                <button class="btn_perfil">
                    <div class="circuloperfil">
                        <figure>
                            <img src="../templates/assets/img/menu-perfil.png"
                                alt="Imagem circular de um usuário genérico para simbolizar o perfil">
                        </figure>
                    </div>
                    <p>Administrador</p>
                </button>
            </div>

            <div class="menu_home">
                <button class="btn_home">
                    <figure>
                        <img src="../templates/assets/img/menu-home.png" alt="casa azul claro">
                    </figure>
                    <p>Home</p>
                </button>
            </div>

            <div class="menu_maquinas">
                <button class="btn_maquinas">
                    <figure>
                        <img src="../templates/assets/img/menu-maquinas.png" alt="Máquina cinza ilustrativa">
                    </figure>
                    <p>Máquinas</p>
                </button>
            </div>

            <div class="menu_clientes">
                <button class="btn_clientes">
                    <figure>
                        <img src="../templates/assets/img/menu-clientes.png"
                            alt="Imagem ilustrativa de uma medalha em torno do ícone de um cliente">
                    </figure>
                    <p>Clientes</p>
                </button>
            </div>

            <div class="menu_chamados">
                <button class="btn_chamados">
                    <figure>
                        <img src="../templates/assets/img/menu-chamadosazul.png"
                            alt="Imagem ilustrativa de um telefone">
                    </figure>
                    <p>Chamados</p>
                </button>
            </div>

            <div class="menu_manutencoes">
                <button class="btn_manutencoes">
                    <figure>
                        <img src="../templates/assets/img/menu-manutencao.png"
                            alt="Imagem ilustrativa de uma engrenagem ao lado de uma ferramenta">
                    </figure>
                    <p>Manutenções</p>
                </button>
            </div>

            <div class="menu_pecas">
                <button class="btn_pecas">
                    <figure>
                        <img src="../templates/assets/img/menu-pecas.png"
                            alt="Imagem ilustrativa de uma caixa de ferramenta">
                    </figure>
                    <p>Solicitações de peças</p>
                </button>
            </div>

            <div class="menu_tecnicos">
                <button class="btn_tecnicos">
                    <figure>
                        <img src="../templates/assets/img/menu-tecnico.png"
                            alt="Imagem ilustrativa de um homem com um capacete de EPI">
                    </figure>
                    <p>Técnicos</p>
                </button>
            </div>

            <div class="menu_logout">
                <button class="btn_logout">
                    <figure>
                        <img src="../templates/assets/img/menu-logout.png"
                            alt="Imagem ilustrativa de uma porta aberta com uma seta indicando a saída">
                    </figure>
                    <p>Logout</p>
                </button>
            </div>
        </nav>
    </aside>

    <main>
        <div class="container">

            <div class="conteudo_superior">
                <h1>Chamados</h1>
                <form method="GET">
                    <div class="input-container">
                        <figure>
                            <img src="../templates/assets/img/lupa_branca.png" alt="">
                        </figure>
                        <input type="text" class="pesquisar" name="search"
                            placeholder="Busque por um Cliente, UF, CNPJ ou Código da Máquina!" autocomplete="off">
                    </div>
                    <button class="procurar">Procurar</button>
                </form>
            </div>

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
                                    echo 'Em aberto';
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
                            <?php
                                if(!empty($chamado['nome_tecnico']) && isset($chamado['nome_tecnico'])) {
                                    echo htmlspecialchars($chamado['nome_tecnico']);
                                } else {
                                    echo 'Nenhum técnico se responsabilizou por esse chamado ainda';
                                }
                            ?>
                        </p>
                    </div>
                </div>
                <?php endforeach;?>

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
        </div>

    </main>

    <script src="../templates/assets/js/pagina_acompanhamento_de_chamados_adm.js"></script>
</body>

</html>