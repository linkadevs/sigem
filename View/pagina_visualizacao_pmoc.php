<?php
require_once __DIR__ . '/../Controller/pmocController.php';

$pmocController = new Controller\PmocController();

$id_manutencao = $_GET['id_manutencao'] ?? null;
$cod_maquina = $_GET['cod_maquina'] ?? null;
$id_tecnico = $_GET['id_tecnico'] ?? null;

$informacoes_maquina = $pmocController->exibir_dadosmaquina($cod_maquina);
$informacoes_manutencao = $pmocController->exibir_dadosmanutencao($cod_maquina, $id_manutencao);
$informacoes_tecnico = $pmocController->exibir_dadostecnico($id_tecnico);

// Decodificar as fotos do JSON
$fotos = [];
if (!empty($informacoes_manutencao['fotos'])) {
    $fotos = json_decode($informacoes_manutencao['fotos'], true);

    // Se não for JSON válido, tenta usar como valor direto (compatibilidade)
    if (!is_array($fotos) && !empty($informacoes_manutencao['fotos'])) {
        $fotos = [$informacoes_manutencao['fotos']];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMOC - <?php echo $informacoes_maquina['nome_maquina'] ?? 'Não encontrado'; ?></title>
    <link rel="stylesheet" href="../templates/assets/css/pagina_visualizacao_pmoc.css">
</head>

<body>
    <header>
        <button class="voltar" onclick="history.back()">
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
                <p>Máquina: <?php echo htmlspecialchars($cod_maquina ?? 'Não informado'); ?></p>
            </div>
            <div class="informacoes">
                <div class="informacao">
                    <p class="titulo">Nome da máquina</p>
                    <p class="conteudo">
                        <?php echo htmlspecialchars($informacoes_maquina['nome_maquina'] ?? 'Não informado'); ?></p>
                </div>
                <div class="informacao2">
                    <p class="titulo">Nome do cliente</p>
                    <p class="conteudo">
                        <?php echo htmlspecialchars($informacoes_maquina['nome_cliente'] ?? 'Não informado'); ?></p>
                </div>
                <div class="informacao">
                    <p class="titulo">Responsável acompanhando</p>
                    <p class="conteudo">
                        <?php echo htmlspecialchars($informacoes_manutencao['acompanhante'] ?? 'Não informado'); ?></p>
                </div>
                <div class="informacao2">
                    <p class="titulo">Capacidade térmica de refrigeração</p>
                    <p class="conteudo">
                        <?php echo htmlspecialchars($informacoes_maquina['capacidade_termica_de_refrigeracao'] ?? 'Não informado'); ?>
                    </p>
                </div>
                <div class="informacao">
                    <p class="titulo">Localização</p>
                    <p class="conteudo">
                        <?php echo htmlspecialchars($informacoes_maquina['localizacao'] ?? 'Não informado'); ?></p>
                </div>
                <div class="informacao2">
                    <p class="titulo">Modelo</p>
                    <p class="conteudo">
                        <?php echo htmlspecialchars($informacoes_maquina['modelo'] ?? 'Não informado'); ?></p>
                </div>
                <div class="informacao">
                    <p class="titulo">Marca</p>
                    <p class="conteudo">
                        <?php echo htmlspecialchars($informacoes_maquina['marca'] ?? 'Não informado'); ?></p>
                </div>
                <div class="informacao2">
                    <p class="titulo">Fluido refrigerante</p>
                    <p class="conteudo">
                        <?php echo htmlspecialchars($informacoes_maquina['fluido_refrigerante'] ?? 'Não informado'); ?>
                    </p>
                </div>
                <div class="informacao">
                    <p class="titulo">Nome do técnico</p>
                    <p class="conteudo"><?php echo htmlspecialchars($informacoes_tecnico['nome'] ?? 'Não informado'); ?>
                    </p>
                </div>
                <div class="informacao2">
                    <p class="titulo">Descrição de serviço</p>
                    <p class="conteudo">
                        <?php echo htmlspecialchars($informacoes_manutencao['descricao_do_servico'] ?? 'Não informado'); ?>
                    </p>
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
                    <p class="conteudo">
                        <?php echo htmlspecialchars($informacoes_manutencao['pressao_aferida'] ?? 'Não informado'); ?>
                    </p>
                </div>
                <div class="informacao">
                    <p class="titulo">Testes e finalização</p>
                    <p class="conteudo">
                        <?php echo htmlspecialchars($informacoes_manutencao['testes_e_finalizacao'] ?? 'Não informado'); ?>
                    </p>
                </div>
                <div class="informacao2">
                    <p class="titulo">Data e hora</p>
                    <p class="conteudo"> <?php
                    // Formata a data do formato americano para brasileiro
                    $data = $informacoes_manutencao['data_e_hora'] ?? '';
                    if ($data && $data != '0000-00-00 00:00:00') {
                        echo date('d/m/Y H:i', strtotime($data));
                    } else {
                        echo 'Data e hora não disponíveis';
                    }
                    ?></p>
                </div>
                <div class="informacao">
                    <p class="titulo">Fotos</p>
                    <p class="conteudo">
                        <?php if (!empty($fotos)): ?>
                        <div class="galeria-fotos">
                            <div class="fotos-miniaturas">
                                <?php foreach ($fotos as $indice => $caminho): ?>
                                    <div class="foto-item">
                                        <a href="/sigem/<?php echo $caminho; ?>" target="_blank">
                                            <img src="/sigem/<?php echo $caminho; ?>" alt="Foto <?php echo $indice + 1; ?>">
                                        </a>
                                        <div class="foto-acoes">
                                            <a href="/sigem/<?php echo $caminho; ?>"
                                                download="foto_<?php echo $indice + 1; ?>.jpg" class="link-download">
                                                📎 Baixar Foto <?php echo $indice + 1; ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if (count($fotos) > 1): ?>
                                <div style="margin-top: 15px;">
                                    <a href="download_zip_fotos.php?id_manutencao=<?php echo $id_manutencao; ?>"
                                        class="btn-zip">
                                        📦 Baixar todas as fotos (ZIP)
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        Nenhuma foto disponível
                    <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>