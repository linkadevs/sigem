<?php
session_start();

$id_tecnico = $_SESSION['id_usuario'];

use Controller\ChamadoController;

require_once __DIR__ . '/../Controller/ChamadoController.php';
require_once __DIR__ . '/../vendor/autoload.php';

$chamadoController = new ChamadoController();

$busca = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($busca)) {
    $chamados = $chamadoController->pesquisarChamadoTecnico($busca, $id_tecnico);
} else {
    $chamados = $chamadoController->selecionarChamadosPorTecnico($id_tecnico);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['id_chamado'] = $_POST['id_chamado'];
    header('Location: detalhamento_de_chamados_tecnico.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atendimento Técnico</title>
    <link rel="stylesheet" href="../templates/assets/css/atendimentotec.css">
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
                        <img src="../templates/assets/img/perfil_tecnico.png" alt="Perfil">
                        <span>Perfil</span>
                    </div>
                    <div class="logout">
                        <img src="../templates/assets/img/menu-logout.png" alt="Logout">
                        <span>Logout</span>
                    </div>
                </div>
            </div>

            <h1>Chamados</h1>

            <form method="GET">
                <div class="input-container">
                    <img src="../templates/assets/img/lupa.png" alt="lupa">
                    <input type="text" name="search" id="pesquisa"
                           placeholder="Busque por um Cliente, UF, CNPJ ou Código da Máquina!"
                           value="<?= htmlspecialchars($busca) ?>" autocomplete="off">
                </div>
                <button type="submit" class="procurar">Procurar</button>
                <?php if ($busca): ?>
                    <a href="?" class="limpar-busca">Limpar</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- MENSAGEM DE RESULTADO DA BUSCA -->
        <?php if ($busca && !empty($busca)): ?>
            <div class="resultado-busca">
                <span>🔍 Resultados da busca por: <strong>"<?= htmlspecialchars($busca) ?>"</strong> - <?= count($chamados) ?> chamado(s) encontrado(s)</span>
            </div>
        <?php endif; ?>

        <!-- GRID DE BLOCOS OU MENSAGEM DE NENHUM CHAMADO -->
        <?php if (!empty($chamados)): ?>
            <div class="container_blocos">
                <?php foreach ($chamados as $chamado): ?>
                    <div class="bloco" id="<?= $chamado['id_chamado'] ?>">
                        <div class="topo_bloco">
                            <h2><?= htmlspecialchars($chamado['nome_cliente']) ?></h2>
                        </div>
                        <div class="conteudo_bloco">
                            <p class="titulo">Status</p>
                            <p class="status">
                                <?php
                                    switch ($chamado['status_chamado']) {
                                        case 'aberto': echo 'Aberto'; break;
                                        case 'em_andamento': echo 'Em andamento'; break;
                                        case 'resolvido': echo 'Resolvido'; break;
                                    }
                                ?>
                            </p>
                            <p class="tecnico">Técnico responsável</p>
                            <p class="nome">
                                <?php if (!empty($chamado['nome_tecnico'])): ?>
                                    <?= htmlspecialchars($chamado['nome_tecnico']) ?>
                                <?php else: ?>
                                    Nenhum técnico se responsabilizou por esse chamado ainda
                                <?php endif; ?>
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
                        <p>Não encontramos resultados para "<?= htmlspecialchars($busca) ?>"</p>
                        <p class="sugestao">Tente buscar por outro termo ou <a href="?">limpar a busca</a></p>
                    <?php else: ?>
                        <h2>Nenhum chamado atribuído</h2>
                        <p>Você ainda não tem chamados atribuídos ou não existem chamados registrados.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <script src="../templates/assets/js/atendimentotec.js" defer></script>
</body>
</html>