<?php
require_once __DIR__ . '/../Controller/PecasController.php';

use Controller\PecasController;

$controller = new PecasController();

$busca = trim($_GET['busca'] ?? '');

if ($busca !== '') {
    $solicitacoes = $controller->pesquisarSolicitacoes($busca);
} else {
    $solicitacoes = $controller->listarSolicitacoes();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitações de peças</title>
    <link rel="stylesheet" href="../templates/assets/css/pagina_gerenciamento_de_pecas_administrador.css">
</head>
<body>

<aside class="menu_lateral">
    <nav>
        <div class="menu_perfil">
            <button class="btn_perfil">
                <div class="circuloperfil">
                    <figure><img src="../templates/assets/img/menu-perfil.png" alt="Perfil"></figure>
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
                <figure><img src="../templates/assets/img/menu-chamados.png" alt="Chamados"></figure>
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
                <figure><img src="../templates/assets/img/menu-pecasazul.png" alt="Peças"></figure>
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
            <h1>Solicitações de peças</h1>
            <form method="GET">
                <div class="input-container">
                    <figure><img src="../templates/assets/img/lupa_branca.png" alt="Lupa"></figure>
                    <input type="text" name="busca" class="pesquisar"
                           placeholder="Busque por uma data ou nome específico!"
                           value="<?= htmlspecialchars($busca) ?>" autocomplete="off">
                </div>
                <button type="submit" class="procurar">Procurar</button>
                <?php if ($busca): ?>
                    <a href="?" class="limpar-busca">Limpar</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- MENSAGEM DE RESULTADO DA BUSCA (se houver busca e não estiver vazia) -->
        <?php if ($busca && !empty($busca)): ?>
            <div class="resultado-busca">
                <span>🔍 Resultados da busca por: <strong>"<?= htmlspecialchars($busca) ?>"</strong> - <?= count($solicitacoes) ?> solicitação(ões) encontrada(s)</span>
            </div>
        <?php endif; ?>

        <!-- LISTAGEM OU MENSAGEM DE NENHUM REGISTRO -->
        <?php if (!empty($solicitacoes)): ?>
            <div class="conteudo_principal">
                <?php foreach ($solicitacoes as $solicitacao_pecas): ?>
                    <div class="bloco">
                        <div class="inforcentro">
                            <div class="topo">
                                <div class="topico">
                                    <p class="titulo">Peça</p>
                                    <p class="infor"><?= htmlspecialchars($solicitacao_pecas['nome_peca']) ?></p>
                                </div>
                                <div class="topico">
                                    <p class="titulo">Quantidade de Peças</p>
                                    <p class="infor"><?= htmlspecialchars($solicitacao_pecas['quantidade_pecas']) ?></p>
                                </div>
                                <div class="topico">
                                    <p class="titulo">Status</p>
                                    <p class="infor status-texto">
                                        <?= $solicitacao_pecas['status'] === 'em_aberto' ? 'Em aberto' : 'Concluído' ?>
                                    </p>
                                </div>
                                <div class="topico">
                                    <p class="titulo">Técnico solicitante</p>
                                    <p class="infor"><?= htmlspecialchars($solicitacao_pecas['nome_tecnico']) ?></p>
                                </div>
                            </div>
                            <div class="descricao">
                                <p><?= htmlspecialchars($solicitacao_pecas['descricao']) ?></p>
                            </div>
                        </div>
                        <div class="lado-direito">
                            <div class="data">
                                <p><?= date('d/m/y', strtotime($solicitacao_pecas['data'])) ?></p>
                            </div>
                            <?php if ($solicitacao_pecas['status'] === 'em_aberto'): ?>
                                <div class="grupo-botoes">
                                    <button class="cancelar" data-id="<?= $solicitacao_pecas['id_solicitacao_pecas'] ?>">Cancelar</button>
                                    <button class="concluir" data-id="<?= $solicitacao_pecas['id_solicitacao_pecas'] ?>">Concluir</button>
                                </div>
                            <?php else: ?>
                                <div class="grupo-botoes">
                                    <button class="concluido">Concluído</button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="nenhum-registro">
                <div class="mensagem-vazia">
                    <?php if ($busca): ?>
                        <h2>Nenhuma solicitação encontrada</h2>
                        <p>Não encontramos resultados para "<?= htmlspecialchars($busca) ?>"</p>
                        <p class="sugestao">Tente buscar por outro termo ou <a href="?">limpar a busca</a></p>
                    <?php else: ?>
                        <h2>Nenhuma solicitação de peças</h2>
                        <p>Não há solicitações de peças registradas até o momento.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</main>

<script src="../templates/assets/js/pagina_gerenciamento_de_pecas_administrador.js"></script>
</body>
</html>