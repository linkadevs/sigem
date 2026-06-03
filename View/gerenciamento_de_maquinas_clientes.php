<?php

session_start();
$id_usuario = $_SESSION['id_usuario'];

use Controller\MaquinaController;
require_once __DIR__ . '/../Controller/MaquinaController.php';
$maquinaController = new MaquinaController();

$busca = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($busca !== '') {
    $array = $maquinaController->pesquisarMaquinaCliente($busca, $id_usuario);
    $maquinas = $array['dados'];
} else {
    $array = $maquinaController->verMaquinasPorCliente($id_usuario);
    $maquinas = $array['dados'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cod_maquina_clicada'])) {
        $_SESSION['cod_maquina'] = $_POST['cod_maquina_clicada'];
        header('Location: pagina_abertura_chamados.php');
        exit;
    }
    if (isset($_POST['historico'])) {
        $_SESSION['cod_maquina'] = $_POST['historico'];
        header('Location: historico_cet_manutencoes.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de máquinas</title>
    <link rel="stylesheet" href="/sigem/templates/assets/css/gerenciamento_de_maquinas_clientes.css">
</head>
<body>
    <button class="voltar">
        <figure>
            <img src="/sigem/templates/assets/img/seta_voltar_semfundo.png" alt="">
        </figure>
    </button>
    <main>
        <div class="container">
            <div class="conteudo_superior">
                <h1>Suas Máquinas</h1>
                <form method="GET" id="searchForm">
                    <div class="input-container">
                        <figure>
                            <img src="/sigem/templates/assets/img/lupa_branca.png" alt="">
                        </figure>
                        <input type="text" name="search" id="searchInput" class="pesquisar"
                            placeholder="Busque por uma data, um código ou máquina específica!"
                            value="<?= htmlspecialchars($busca) ?>"
                            autocomplete="off">
                    </div>
                    <button type="submit" class="procurar">Procurar</button>
                    <button type="button" class="limpar-filtro" id="limparBtn"
                        onclick="window.location.href='gerenciamento_de_maquinas_clientes.php'">Limpar</button>
                </form>
            </div>

            <!-- MENSAGEM DE RESULTADO DA BUSCA -->
            <?php if ($busca !== ''): ?>
                <div class="resultado-busca">
                    <span>🔍 Resultados da busca por: <strong>"<?= htmlspecialchars($busca) ?>"</strong> - <?= count($maquinas) ?> máquina(s) encontrada(s)</span>
                </div>
            <?php endif; ?>

            <div class="grid_cards">
                <?php if (!empty($maquinas)): ?>
                    <?php foreach ($maquinas as $maquina): ?>
                        <div class="card">
                            <h2 class="maquina"><?= htmlspecialchars($maquina['nome_maquina']) ?></h2>
                            <p class="codigo"><?= htmlspecialchars($maquina['cod_maquina']) ?></p>
                            <hr>
                            <h3 class="manutencao">Última manutenção</h3>
                            <div class="dados">
                                <div class="informacaoazul">
                                    <p class="tecnico">Técnico:</p>
                                    <p class="nome">José Silva de Jesus</p>
                                </div>
                                <div class="informacao">
                                    <p class="servico">Serviço:</p>
                                    <p class="tipo">Manutenção Preventiva</p>
                                </div>
                                <div class="informacaoazul">
                                    <p class="data">Data:</p>
                                    <p class="dia">10/05/2026</p>
                                </div>
                                <div class="informacao">
                                    <p class="hora">Hora:</p>
                                    <p class="horario">10:00</p>
                                </div>
                            </div>
                            <form method="POST">
                                <div class="botoes">
                                    <button class="historico" name="historico" value="<?= htmlspecialchars($maquina['cod_maquina']) ?>">Ver histórico</button>
                                    <button class="chamado" name="cod_maquina_clicada" value="<?= htmlspecialchars($maquina['cod_maquina']) ?>">Abrir chamado</button>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- MENSAGEM DE NENHUMA MÁQUINA -->
                    <div class="nenhuma-maquina">
                        <div class="mensagem-vazia">
                            <?php if ($busca !== ''): ?>
                                <h2>Nenhuma máquina encontrada</h2>
                                <p>Não encontramos resultados para "<?= htmlspecialchars($busca) ?>"</p>
                                <p class="sugestao">Tente buscar por outro termo ou <a href="gerenciamento_de_maquinas_clientes.php">limpar a busca</a></p>
                            <?php else: ?>
                                <h2>Nenhuma máquina cadastrada</h2>
                                <p>Você ainda não possui máquinas vinculadas.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <script>
        // Controle do botão Limpar (aparece apenas quando há texto no input)
        const searchInput = document.getElementById('searchInput');
        const limparBtn = document.getElementById('limparBtn');

        function toggleLimparBtn() {
            if (searchInput.value.trim() !== '') {
                limparBtn.style.display = 'flex';
            } else {
                limparBtn.style.display = 'none';
            }
        }

        toggleLimparBtn();
        searchInput.addEventListener('input', toggleLimparBtn);

        // Botão voltar
        const voltar = document.querySelector('.voltar');
        if (voltar) {
            voltar.addEventListener('click', () => {
                window.location.href = 'pagina_principal_cliente.php';
            });
        }
    </script>
</body>
</html>