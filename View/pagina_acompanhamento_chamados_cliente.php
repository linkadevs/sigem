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

if($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    <main>
        <div class="container">

            <div class="conteudo_superior">
                <h1>Seus chamados</h1>
                <form method="GET">
                    <div class="input-container">
                        <figure>
                            <img src="../templates/assets/img/lupa_branca.png" alt="">
                        </figure>
                        <input type="text" class="pesquisar" name="search"
                            placeholder="Busque pela data, Código ou nome da Máquina!">
                    </div>
                    <button class="procurar">Procurar</button>
                </form>
            </div>

            <div class="cards">
                <?php if(empty($chamados) || !isset($chamados)):?>
                    <strong>Nenhum chamado encontrado</strong>
                <?php endif;?>
                <?php foreach ($chamados as $chamado):?>
                <div class="card">
                    <div class="d1">
                        <p class="status">Status: <span><?= htmlspecialchars($chamado['status_chamado'])?></span></p>
                        <p class="data">Data: <?= htmlspecialchars($chamado['data_chamado'])?></p>
                    </div>
                    <div class="d2">
                        <p class="codigo">Código da máquina: <?= htmlspecialchars($chamado['cod_maquina'])?></p>
                        <p class="nomeDaMaquina"><span>Nome da maquina:</span> <?= htmlspecialchars($chamado['nome_maquina'])?></p>
                    </div>
                    <p class="tituloDescricao">Descrição do Problema</p>
                    <div class="d3">
                        <p class="descricao"><?= htmlspecialchars($chamado['descricao_chamado'])?></p>
                        <form method="POST"><button class="cancelar" name="cancelar" value="<?= $chamado['id_chamado']?>" onclick="return confirm('Tem certeza que deseja apagar esse chamado? Essa ação não poderá ser desfeita.')">Cancelar</button></form>
                    </div>
                    <div class="grid">
                        <?php 
                            $fotos = json_decode($chamado['fotos_chamado'], true);

                            foreach ($fotos as $foto) {
                                echo '<figure><img src="../'.$foto.'"></figure>';
                            }
                        ?>
                    </div>
                </div>
                <?php endforeach;?>
                <!-- <div class="card">
                    <div class="d1">
                        <p class="status">Status: <span>Em aberto</span></p>
                        <p class="data">Data: 14/04/2026</p>
                    </div>
                    <div class="d2">
                        <p class="codigo">Código da máquina: 055</p>
                        <p class="nomeDaMaquina"><span>Nome da maquina:</span> Ar condicionado</p>
                    </div>
                    <p class="tituloDescricao">Descrição do Problema</p>
                    <div class="d3">
                        <p class="descricao">A máquina está apresentando falhas durante o funcionamento, com interrupções inesperadas no processo e ruídos incomuns.</p>
                        <button class="cancelar">Cancelar</button>
                    </div>
                    <div class="grid">
                        <figure><img src="../templates/assets/img/img-chamado1.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado2.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado3.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado4.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado5.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado6.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado1.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado2.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado3.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado4.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado5.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado6.png" alt=""></figure>
                    </div>
                </div>
                <div class="card">
                    <div class="d1">
                        <p class="status">Status: <span>Em aberto</span></p>
                        <p class="data">Data: 14/04/2026</p>
                    </div>
                    <div class="d2">
                        <p class="codigo">Código da máquina: 055</p>
                        <p class="nomeDaMaquina"><span>Nome da maquina:</span> Ar condicionado</p>
                    </div>
                    <p class="tituloDescricao">Descrição do Problema</p>
                    <div class="d3">
                        <p class="descricao">A máquina está apresentando falhas durante o funcionamento, com interrupções inesperadas no processo e ruídos incomuns.</p>
                        <button class="cancelar">Cancelar</button>
                    </div>
                    <div class="grid">
                        <figure><img src="../templates/assets/img/img-chamado1.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado2.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado3.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado4.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado5.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado6.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado1.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado2.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado3.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado4.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado5.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado6.png" alt=""></figure>
                    </div>
                </div>
                <div class="card">
                    <div class="d1">
                        <p class="status">Status: <span>Em aberto</span></p>
                        <p class="data">Data: 14/04/2026</p>
                    </div>
                    <div class="d2">
                        <p class="codigo">Código da máquina: 055</p>
                        <p class="nomeDaMaquina"><span>Nome da maquina:</span> Ar condicionado</p>
                    </div>
                    <p class="tituloDescricao">Descrição do Problema</p>
                    <div class="d3">
                        <p class="descricao">A máquina está apresentando falhas durante o funcionamento, com interrupções inesperadas no processo e ruídos incomuns.</p>
                        <button class="cancelar">Cancelar</button>
                    </div>
                    <div class="grid">
                        <figure><img src="../templates/assets/img/img-chamado1.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado2.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado3.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado4.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado5.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado6.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado1.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado2.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado3.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado4.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado5.png" alt=""></figure>
                        <figure><img src="../templates/assets/img/img-chamado6.png" alt=""></figure>
                    </div>
                </div> -->
            </div>
        </div>

    </main>
<script src="../templates/assets/js/pagina_acompanhamento_chamados_cliente.js"></script>
</body>

</html>