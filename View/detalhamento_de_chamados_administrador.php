<?php
session_start();

use Controller\ChamadoController;
require_once __DIR__ . '/../Controller/ChamadoController.php';
require_once __DIR__ . '/../vendor/autoload.php';

$chamadoController = new ChamadoController();
$id_chamado = $_GET['id_chamado'];
$chamado = $chamadoController->selecionarChamadosPorId($id_chamado);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhamento de Chamados</title>
    <link rel="stylesheet" href="../templates/assets/css/detalhamento_de_chamados_administrador.css">
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
            <div class="topo">
                <button class="voltar" onclick="history.back()">
                    <figure><img src="../templates/assets/img/seta_voltar_semfundo.png" alt="Voltar"></figure>
                </button>
            </div>
            <div class="titulo_chamados">
                <h1>Chamados</h1>
            </div>
        </div>

        <div class="informacoes">
            <div class="sobreochamado">

                <div class="linha">
                    <div class="cliente">
                        <p class="titulo">Cliente:</p>
                        <p class="campo"><?= htmlspecialchars($chamado['nome_cliente'])?></p>
                    </div>
                    <div class="cnpj">
                        <p class="titulo">CNPJ:</p>
                        <p class="campo"><?= htmlspecialchars($chamado['cnpj_cliente'])?></p>
                    </div>
                </div>

                <div class="linha">
                    <div class="nomemaquina">
                        <p class="titulo">Nome da máquina:</p>
                        <p class="campo"><?= htmlspecialchars($chamado['nome_maquina'])?></p>
                    </div>
                    <div class="codigo">
                        <p class="titulo">Código da Máquina:</p>
                        <p class="campo"><?= htmlspecialchars($chamado['cod_maquina'])?></p>
                    </div>
                </div>

                <div class="linha">
                    <div class="uf">
                        <p class="titulo">UF:</p>
                        <p class="campo"><?= htmlspecialchars($chamado['uf_cliente'])?></p>
                    </div>
                    <div class="cidade">
                        <p class="titulo">Cidade:</p>
                        <p class="campo"><?= htmlspecialchars($chamado['cidade_cliente'])?></p>
                    </div>
                </div>

                <div class="linha">
                    <div class="localizacao">
                        <p class="titulo">Localização:</p>
                        <p class="campo"><?= htmlspecialchars($chamado['localizacao_maquina'])?></p>
                    </div>
                    <div class="contato">
                        <p class="titulo">Contato:</p>
                        <p class="campo"><?= htmlspecialchars($chamado['contato_cliente'])?></p>
                    </div>
                </div>

                <div class="linha">
                    <div class="status">
                        <p class="titulo">Status:</p>
                        <p class="campo">
                            <?php
                                switch ($chamado['status_chamado']) {
                                    case 'aberto': echo 'Aberto'; break;
                                    case 'em_andamento': echo 'Em andamento'; break;
                                    case 'resolvido': echo 'Resolvido'; break;
                                }
                            ?>
                        </p>
                    </div>
                    <div class="data">
                        <p class="titulo">Data:</p>
                        <p class="campo"><?= htmlspecialchars($chamado['data_chamado'])?></p>
                    </div>
                </div>

                <div class="linha_descricao">
                    <div class="descricao">
                        <p class="titulo_descricao">Descrição do problema:</p>
                        <p class="campodescricao"><?= htmlspecialchars($chamado['descricao_chamado'])?></p>
                    </div>
                </div>

            </div>
        </div>

        <div class="fotos">
            <?php
                $fotos = json_decode($chamado['fotos_chamado'], true);
                if(!empty($fotos) && isset($fotos)) {
                    foreach($fotos as $foto){
                        echo '<figure><img src="../'.$foto.'" alt="Foto do chamado"></figure>';
                    }
                } else {
                    echo '<strong>Nenhuma foto para esse chamado</strong>';
                }
            ?>
        </div>

    </div>
</main>

<!-- MODAL PARA AMPLIAR IMAGEM -->
<div class="modal" id="imageModal">
    <button class="modal-close" id="closeModal">&times;</button>
    <img class="modal-img" id="modalImg" src="" alt="Imagem ampliada">
</div>

<script src="../templates/assets/js/detalhamento_de_chamados_administrador.js"></script>
</body>
</html>