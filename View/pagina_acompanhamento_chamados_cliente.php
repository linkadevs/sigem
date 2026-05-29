<?php

session_start();

$_SESSION['id_usuario'] = 2;

$id_cliente = $_SESSION['id_usuario'];

use Controller\ChamadoController;

require_once __DIR__ . '/../Controller/ChamadoController.php';
require_once __DIR__ . '/../vendor/autoload.php';

$chamadoController = new ChamadoController();

if (!empty($_GET['search']) && isset($_GET['search'])) {
    $pesquisa = $_GET['search'];
    $chamados = $chamadoController->pesquisarChamadoCliente(
        $pesquisa,
        $id_cliente
    );
} else {
    $chamados = $chamadoController->selecionarChamadosPorCliente($id_cliente);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $chamadoController->deletarChamado($_POST['cancelar']);
    header('Location: pagina_acompanhamento_chamados_cliente.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de clientes</title>
    <link rel="stylesheet" href="../templates/assets/css/pagina_acompanhamento_chamados_cliente.css">
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
                <h1>Seus chamados</h1>
                <form method="GET" id="searchForm">
                    <div class="input-container">
                        <figure>
                            <img src="../templates/assets/img/lupa_branca.png" alt="">
                        </figure>
                        <input type="text" class="pesquisar" name="search" id="searchInput"
                            placeholder="Busque pela data, Código ou nome da Máquina!" autocomplete="off"
                            value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    </div>
                    <button class="procurar" type="submit">Procurar</button>
                    <button type="button" class="limpar-filtro" id="limparBtn"
                        onclick="window.location.href='pagina_acompanhamento_chamados_cliente.php'">Limpar</button>
                </form>
            </div>

            <div class="cards">
                <?php if (empty($chamados) || !isset($chamados)): ?>
                    <strong>Nenhum chamado encontrado</strong>
                <?php endif; ?>
                <?php foreach ($chamados as $chamado): ?>
                    <div class="card">
                        <div class="d1">
                            <p class="status">Status: <span>
                                    <?php
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
                                    ?>
                                </span></p>
                            <p class="data">Data: <?= htmlspecialchars($chamado['data_chamado']) ?></p>
                        </div>
                        <div class="d2">
                            <p class="codigo">Código da máquina: <?= htmlspecialchars($chamado['cod_maquina']) ?></p>
                            <p class="nomeDaMaquina"> <?= htmlspecialchars($chamado['nome_maquina']) ?></p>
                        </div>
                        <p class="tituloDescricao">Descrição do Problema</p>
                        <div class="d3">
                            <p class="descricao"><?= htmlspecialchars($chamado['descricao_chamado']) ?></p>
                            <form method="POST">
                                <button class="cancelar" name="cancelar" value="<?= $chamado['id_chamado'] ?>"
                                    onclick="return confirm('Tem certeza que deseja apagar esse chamado? Essa ação não poderá ser desfeita.')">Cancelar</button>
                            </form>
                        </div>
                        <div class="grid">
                            <?php
                            $fotos = json_decode($chamado['fotos_chamado'], true);
                            foreach ($fotos as $foto) {
                                echo '<figure><img src="../' . $foto . '"></figure>';
                            }
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
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

        // Executa ao carregar e ao digitar
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