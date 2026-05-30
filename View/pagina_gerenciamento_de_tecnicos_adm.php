<?php
// 1. IMPORTAÇÃO DO CONTROLLER
require_once __DIR__ . '/../Controller/GerenciamentoTecController.php';
use Controller\GerenciamentoTecController;

$controller = new GerenciamentoTecController();

// 2. LÓGICA DE BUSCA
$busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

$tecnicos = $controller->pesquisarTecnicos($busca);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Técnicos</title>
    <link rel="stylesheet" href="../templates/assets/css/pagina_gerenciamento_de_tecnicos_adm.css">
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
                <figure><img src="../templates/assets/img/menu-manuntencao.png" alt="Manutenções"></figure>
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
                <figure><img src="../templates/assets/img/menu-tecnicoazul.png" alt="Técnicos"></figure>
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
            <h1>Técnicos</h1>
            <form method="GET" action="pagina_gerenciamento_de_tecnicos_adm.php">
                <div class="input-container">
                    <figure><img src="../templates/assets/img/lupa_branca.png" alt=""></figure>
                    <input type="text" class="pesquisar" name="busca" id="busca"
                           placeholder="Busque por um nome, CPF ou função!"
                           value="<?= htmlspecialchars($busca) ?>" autocomplete="off">
                </div>
                <button class="procurar" type="submit">Procurar</button>
                <?php if ($busca): ?>
                    <a href="?" class="limpar-busca">Limpar</a>
                <?php endif; ?>
            </form>
        </div>

        <button class="btn_colaborador" type="button">
            <figure><img src="../templates/assets/img/sinal-de-adicao.png" alt=""></figure>
            Novo colaborador
        </button>

        <?php if ($busca): ?>
            <div class="resultado-busca">
                <span>🔍 Resultados da busca por: <strong>"<?= htmlspecialchars($busca) ?>"</strong> - <?= count($tecnicos) ?> técnico(s) encontrado(s)</span>
            </div>
        <?php endif; ?>

        <?php if (!empty($tecnicos)): ?>
            <div class="grid_cards">
                <?php foreach ($tecnicos as $tecnico): ?>
                    <div class="card">
                        <h2 class="nome"><?= htmlspecialchars($tecnico['nome']) ?></h2>
                        <p class="email"><?= htmlspecialchars($tecnico['email'])?></p>
                        <div class="container_informacoes">
                            <div class="informacoes">
                                <div class="container_cpf">
                                    <div class="cpf"><h1>CPF:</h1></div>
                                    <div class="dados_cpf"><h1><?= htmlspecialchars($tecnico['cpf']) ?></h1></div>
                                </div>
                                <div class="container_funcao">
                                    <div class="funcao"><h1>Função:</h1></div>
                                    <div class="dados_funcao"><h1><?= htmlspecialchars($tecnico['funcao']) ?></h1></div>
                                </div>
                            </div>
                        </div>
                        <div class="btn_card">
                            <a href="pagina_cadastro_tecnicos_administrador.php?id=<?= $tecnico['id_tecnico'] ?>">
                                <button class="editar">Editar</button>
                            </a>
                            <button type="button" data-id="<?= $tecnico['id_tecnico'] ?>" class="excluir">Excluir</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="nenhum-registro">
                <div class="mensagem-vazia">
                    <?php if ($busca): ?>
                        <h2>Nenhum técnico encontrado</h2>
                        <p>Não encontramos resultados para "<?= htmlspecialchars($busca) ?>"</p>
                        <p class="sugestao">Tente buscar por outro termo ou <a href="?">limpar a busca</a></p>
                    <?php else: ?>
                        <h2>Nenhum técnico cadastrado</h2>
                        <p>Clique em "Novo colaborador" para adicionar.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</main>

<script src="../templates/assets/js/pagina_gerenciamento_de_tecnicos_adm.js"></script>
</body>
</html>