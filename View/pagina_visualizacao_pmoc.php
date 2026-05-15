<?php
require_once __DIR__ . '/../Controller/PMOCController.php';

$pmocController = new Controller\PmocController();

$id_manutencao = $_GET['id_manutencao'] ?? null;
$cod_maquina = $_GET['cod_maquina'] ?? null;
$id_tecnico = $_GET['id_tecnico'] ?? null;


$informacoes_maquina = $pmocController->exibir_dadosmaquina($cod_maquina);
$informacoes_manutencao = $pmocController->exibir_dadosmanutencao($cod_maquina, $id_manutencao);
$informacoes_tecnico = $pmocController->exibir_dadostecnico($id_tecnico);
?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMOC - <?php echo $informacoes_maquina['nome_maquina']; ?></title>
    <link rel="stylesheet" href="../templates/assets/css/pagina_visualizacao_pmoc.css">
</head>

<body>
    <header>
        <button class="voltar">
            <figure class="voltarFigure">
                <img class="voltarImg" src="../templates/assets/img/seta_voltar_semfundo.png" alt="">
            </figure>
            Voltar
        </button>
    </header>
    <main>
        <div class="fundoPmoc">
            <div class="tituloPmoc">
                <h1>Visualizar PMOC</h1>
                <p>Máquina: <?php echo $cod_maquina ?></p>
            </div>
            <div class="informacoes">
                <div class="informacao">
                    <p class="titulo">Nome da máquina</p>
                    <p class="conteudo"><?php echo $informacoes_maquina['nome_maquina']; ?></p>
                </div>
                <div class="informacao2">
                    <p class="titulo">Nome do cliente</p>
                    <p class="conteudo"><?php echo $informacoes_maquina['nome_cliente']; ?></p>
                </div>
                <div class="informacao">
                    <p class="titulo">Responsável acompanhando</p>
                    <p class="conteudo"><?php echo $informacoes_tecnico['nome_tecnico']; ?></p>
                </div>
                <div class="informacao2">
                    <p class="titulo">Capacidade térmica de refrigeração</p>
                    <p class="conteudo"><?php echo $informacoes_maquina['capacidade_termica']; ?></p>
                </div>
                <div class="informacao">
                    <p class="titulo">Localização</p>
                    <p class="conteudo"><?php echo $informacoes_maquina['localizacao']; ?></p>
                </div>
                <div class="informacao2">
                    <p class="titulo">Modelo</p>
                    <p class="conteudo"><?php echo $informacoes_maquina['modelo']; ?></p>
                </div>
                <div class="informacao">
                    <p class="titulo">Marca</p>
                    <p class="conteudo"><?php echo $informacoes_maquina['marca']; ?></p>
                </div>
                <div class="informacao2">
                    <p class="titulo">Fluido refrigerante</p>
                    <p class="conteudo"><?php echo $informacoes_maquina['fluido_refrigerante']; ?></p>
                </div>
                <div class="informacao">
                    <p class="titulo">Nome do técnico</p>
                    <p class="conteudo"><?php echo $informacoes_tecnico['nome_tecnico']; ?></p>
                </div>
                <div class="informacao2">
                    <p class="titulo">Descrição de serviço</p>
                    <p class="conteudo"><?php echo $informacoes_manutencao['descricao_servico']; ?></p>
                </div>
                <div class="informacao">
                    <p class="titulo">Tipo de serviço</p>
                    <p class="conteudo"><?php
                    $tipo = $informacoes_manutencao['tipo_de_servico'] ?? '';
                    if ($tipo === 'instalacao') {
                        echo 'Instalação';
                    } elseif ($tipo === 'manutencao_corretiva') {
                        echo 'Manutenção corretiva';
                    } elseif ($tipo === 'manutencao_preventiva') {
                        echo 'Manutenção preventiva';
                    } else {
                        echo 'Não especificado';
                    }
                    ?></p>
                </div>
                <div class="informacao2">
                    <p class="titulo">Pressão aferida</p>
                    <p class="conteudo"><?php echo $informacoes_manutencao['pressao_aferida']; ?></p>
                </div>
                <div class="informacao">
                    <p class="titulo">Testes e finalização</p>
                    <p class="conteudo"><?php echo $informacoes_manutencao['testes_finalizacao']; ?></p>
                </div>
                <div class="informacao2">
                    <p class="titulo">Data e hora</p>
                    <p class="conteudo"><?php echo $informacoes_manutencao['data_hora']; ?></p>
                </div>
                <div class="informacao">
                    <p class="titulo">Fotos</p>
                    <p class="conteudo"><?php echo $informacoes_manutencao['fotos']; ?></p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>