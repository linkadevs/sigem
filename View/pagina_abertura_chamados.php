<?php

session_start();
$id_cliente = $_SESSION['id_usuario'];
$cod_maquina = $_SESSION['cod_maquina'];
use Controller\MaquinaController;
use Controller\GerenciamentoClienteController;
use Controller\ChamadoController;
require_once __DIR__ . '/../Controller/ChamadoController.php';
require_once __DIR__ . '/../Controller/GerenciamentoClienteController.php';
require_once __DIR__ . '/../Controller/MaquinaController.php';
require_once __DIR__ . '/../vendor/autoload.php';
$chamadoController = new ChamadoController();
$gerenciamentoClienteController = new GerenciamentoClienteController();
$maquinaController = new MaquinaController();

$array = $maquinaController->verMaquinasPorCodigo($cod_maquina);
$maquina = $array['dados'];
$cliente = $gerenciamentoClienteController->buscarClientePorId($id_cliente);

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrar manutenção</title>
        <link rel="stylesheet" href="../templates/assets/css/pagina_abertura_chamados.css">
    </head>
    <body>
        <header>
            <button class="botaoVoltar">
                <figure class="voltarFigure"><img src="../templates/assets/img/seta_voltar.png" alt="Seta apontando para a esquerda para voltar à página anterior" class="voltarImg"></figure>
                Realize um novo chamado
            </button>
        </header>
        <main>
            <div class="conteiner">
                <figure><img src="../templates/assets/img/fundo_chamado.png" alt="Engrenagens e ícones interconectados representando o fluxo de trabalho de gerenciamento de manutenção com análises, marcas de seleção e símbolos de fluxo de processo em um fundo de rede digital."></figure>
                <form action="salvar_chamado.php" method="POST" enctype="multipart/form-data">
                    <div class="inputs">
                        <div class="input">
                            <label for="cliente">Nome</label>
                            <input type="text" name="nome" id="nome" value="<?= $cliente['nome']?>" disabled>
                        </div>
                        <div class="dataUf">
                            <div class="input">
                                <label for="data">Data</label>
                                <input type="date" name="data" id="data" value="<?= date('Y-m-d')?>" disabled>
                            </div>
                            <div class="input">
                                <label for="uf">UF</label>
                                <input type="text" name="uf" id="uf" placeholder="Estado" value="<?= $cliente['uf']?>" disabled>
                            </div>
                        </div>
                        <div class="input">
                            <label for="cidade">Cidade</label>
                            <input type="text" name="cidade" id="cidade" placeholder="Insira a cidade do chamado" value="<?= $cliente['cidade']?>" disabled>
                        </div>
                        <div class="input">
                            <label for="localizacao">Localização</label>
                            <input type="text" name="localizacao" id="localizacao" placeholder="Insira o local do chamado" value="<?= $maquina['localizacao']?>" disabled>
                        </div>
                        <div class="input">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" id="descricao" placeholder="Descreva brevemente o problema apresentado"></textarea>
                        </div>
                        <div class="input">
                            <label for="fotos">Fotos</label>
                            <button id="botaoFotos" name="botaoFotos">Selecione fotos da manutenção</button>
                            <input type="file" name="fotos[]" id="fotos" accept="image/*" multiple>
                        </div>
                        <div class="grid"></div>
                    </div>
                    <button class="enviar" id="enviar" type="submit">Enviar</button>
                </form>
            </div>
        </main>
        <script src="../templates/assets/js/pagina_abertura_chamados.js"></script>
    </body>
</html>