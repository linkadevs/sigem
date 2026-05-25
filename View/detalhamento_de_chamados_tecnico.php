<?php

session_start();

use Controller\ChamadoController;
require_once __DIR__ . '/../Controller/ChamadoController.php';
require_once __DIR__ . '/../vendor/autoload.php';
$chamadoController = new ChamadoController();
$id_chamado = $_SESSION['id_chamado'];
$id_usuario = $_SESSION['id_usuario'];

$chamado = $chamadoController->selecionarChamadosPorId($id_chamado);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['responsabilizarse']) && isset($_POST['responsabilizarse'])) {
        $chamadoController->responsabilizarse(
            $id_usuario,
            $id_chamado
        );
        header('Location: detalhamento_de_chamados_tecnico.php');
        exit();
    }

    if (!empty($_POST['concluir']) && isset($_POST['concluir'])) {
        $_SESSION['cod_maquina'] = $chamado['cod_maquina'];
        // $chamadoController->finalizarChamado(
        //     $id_chamado
        // );
        header('Location: registro_nova_manutencao.php');
        exit();
    }

    if (!empty($_POST['cancelar']) && isset($_POST['cancelar'])) {
        $chamadoController->cancelar(
            $id_chamado
        );
        header('Location: detalhamento_de_chamados_tecnico.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhamento de chamado</title>
    <link rel="stylesheet" href="../templates/assets/css/detalhamento_de_chamados_tecnico.css">
</head>

<body>
    <main>

        <div class="conteudo_superior">
            <div class="topo">
                <button class="voltar">
                    <figure>
                        <img src="../templates/assets/img/seta_voltar_semfundo.png" alt="">
                    </figure>
                </button>
                <div class="direita">
                    <button class="perfil">
                        <figure>
                            <img src="../templates/assets/img/perfiltec.png" alt="">
                        </figure>
                        Perfil
                    </button>
                    <button class="logout">
                        <figure>
                            <img src="../templates/assets/img/menu-logout.png" alt="">
                        </figure>
                        Logout
                    </button>
                </div>
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
                        <p class="titulo">Localização</p>
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
                        echo '<figure><img src="../'.$foto.'"></figure>';
                    }
                } else {
                    echo '<strong>Nenhuma foto para esse chamado</strong>';
                }
            ?>
        </div>


        <div class="botoes">
            <form method="POST">
                <?php if($chamado['status_chamado'] === 'aberto'):?>
                    <button class="responsabilizarse" name="responsabilizarse" value="true">Responsabilizar-se</button>
                <?php elseif($chamado['status_chamado'] === 'em_andamento'):?>
                    
                    <button class="concluido" name="concluir" value="true">Marcar como concluído</button>
                    <button class="cancelar" name="cancelar" value="true">Cancelar</button>
                    
                <?php else:?>
                    
                    <button class="cancelar" name="responsabilizarse" value="true">Desmarcar como concluído</button>
                    
                <?php endif;?>
            </form>
        </div>
    </main>
    <script src="../templates/assets/js/detalhamento_de_chamados_tecnico.js"></script>
</body>

</html>