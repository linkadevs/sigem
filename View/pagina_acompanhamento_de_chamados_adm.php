<?php

use Controller\ChamadoController;
require_once __DIR__ . '/../Controller/ChamadoController.php';
require_once __DIR__ . '/../vendor/autoload.php';

$chamadoController = new ChamadoController();
$busca = trim($_GET['search'] ?? '');

if (!empty($busca)) {
    $chamados = $chamadoController->pesquisarChamado($busca);
} else {
    $chamados = $chamadoController->selecionarTodosOsChamados();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acompanhamento de chamados</title>
    <link rel="stylesheet" href="../templates/assets/css/pagina_acompanhamento_de_chamados_adm..css">
</head>
<body>

    <aside class="menu_lateral">
        <nav>
            <div class="menu_perfil">
                <button class="btn_perfil">
                    <div class="circuloperfil">
                        <figure>
                            <img src="../templates/assets/img/menu-perfil.png" alt="Perfil">
                        </figure>
                    </div>
                    <p>Administrador</p>
                </button>
            </div>

            <div class="menu_home">
                <button class="btn_home">
                    <figure><img src="../templates/assets/img/menu-home.png" alt="Home"></figure>
                    <p>Home</p>
                </button>
            </div>

            <div class="menu_maquinas">
                <button class="btn_maquinas">
                    <figure><img src="../templates/assets/img/menu-maquinas.png" alt="Máquinas"></figure>
                    <p>Máquinas</p>
                </button>
            </div>

            <div class="menu_clientes">
                <button class="btn_clientes">
                    <figure><img src="../templates/assets/img/menu-clientes.png" alt="Clientes"></figure>
                    <p>Clientes</p>
                </button>
            </div>

            <div class="menu_chamados">
                <button class="btn_chamados">
                    <figure><img src="../templates/assets/img/menu-chamadosazul.png" alt="Chamados"></figure>
                    <p>Chamados</p>
                </button>
            </div>

            <div class="menu_manutencoes">
                <button class="btn_manutencoes">
                    <figure><img src="../templates/assets/img/menu-manutencao.png" alt="Manutenções"></figure>
                    <p>Manutenções</p>
                </button>
            </div>

            <div class="menu_pecas">
                <button class="btn_pecas">
                    <figure><img src="../templates/assets/img/menu-pecas.png" alt="Peças"></figure>
                    <p>Solicitações de peças</p>
                </button>
            </div>

            <div class="menu_tecnicos">
                <button class="btn_tecnicos">
                    <figure><img src="../templates/assets/img/menu-tecnico.png" alt="Técnicos"></figure>
                    <p>Técnicos</p>
                </button>
            </div>

            <div class="menu_logout">
                <button class="btn_logout">
                    <figure><img src="../templates/assets/img/menu-logout.png" alt="Logout"></figure>
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
                        <figure><img src="../templates/assets/img/lupa_branca.png" alt=""></figure>
                        <input type="text" class="pesquisar" name="search"
                               placeholder="Busque por um Cliente, UF, CNPJ ou Código da Máquina!"
                               value="<?php echo htmlspecialchars($busca); ?>" autocomplete="off">
                    </div>
                    <button class="procurar">Procurar</button>
                    <?php if ($busca): ?>
                        <a href="?" class="limpar-busca">Limpar</a>
                    <?php endif; ?>
                </form>
            </div>

            <?php if ($busca && !empty($busca)): ?>
                <div class="resultado-busca">
                    <span>🔍 Resultados da busca por: <strong>"<?php echo htmlspecialchars($busca); ?>"</strong> - <?php echo count($chamados); ?> chamado(s) encontrado(s)</span>
                </div>
            <?php endif; ?>

            <?php if (!empty($chamados)): ?>
                <div class="container_blocos">
                    <?php foreach ($chamados as $chamado): ?>
                        <div class="bloco" id="<?= $chamado['id_chamado'] ?>">
                            <div class="topo_bloco">
                                <h2><?= htmlspecialchars($chamado['nome_cliente']) ?></h2>
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
                                        default:
                                            echo htmlspecialchars($chamado['status_chamado']);
                                    }
                                ?></p>
                                <p class="tecnico">Técnico responsável</p>
                                <p class="nome">
                                    <?php
                                        if (!empty($chamado['nome_tecnico']) && isset($chamado['nome_tecnico'])) {
                                            echo htmlspecialchars($chamado['nome_tecnico']);
                                        } else {
                                            echo 'Nenhum técnico se responsabilizou por esse chamado ainda';
                                        }
                                    ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="nenhum-chamado">
                    <div class="mensagem-vazia">
                        <?php if ($busca): ?>
                            <h2>Nenhum chamado encontrado</h2>
                            <p>Não encontramos resultados para "<?php echo htmlspecialchars($busca); ?>"</p>
                            <p class="sugestao">Tente buscar por outro termo ou <a href="?">limpar a busca</a></p>
                        <?php else: ?>
                            <h2>Nenhum chamado cadastrado</h2>
                            <p>Novos chamados aparecerão aqui.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script src="../templates/assets/js/pagina_acompanhamento_de_chamados_adm.js"></script>
</body>
</html>