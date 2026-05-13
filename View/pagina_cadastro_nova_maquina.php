<?php

use Controller\MaquinaController;
use Controller\ClienteController;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Controller/MaquinaController.php';
require_once __DIR__ . '/../Controller/ClienteController.php';

$clienteController = new ClienteController();
$maquinaController = new MaquinaController();

$clientes = $clienteController->SelecionarTodosClientes();


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_maquina = $_POST['nome_maquina'];
    $localizacao = $_POST['localizacao'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $fluido_refrigerante = $_POST['fluido_refrigerante'];
    $capacidade_termica_de_refrigeracao = $_POST['capacidade_termica'];
    $id_cliente_fk = $_POST['id_cliente'];


    $result = $maquinaController->criarMaquina(
        $nome_maquina,
        $localizacao,
        $marca,
        $modelo,
        $fluido_refrigerante,
        $capacidade_termica_de_refrigeracao,
        $id_cliente_fk
    );
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../templates/assets/css/pagina_cadastro_nova_maquina.css">
    <title>Cadastro de Máquina</title>
</head>
<body>
    <header>
        <div class="voltar_header">
            <figure>
                <img src="../templates/assets/img/seta_voltar.png" alt="Voltar">
            </figure>
            
            <h1>Voltar</h1>
        </div>
    </header>
        
    <main>
        <div class="form_main">
            <div class="titulo_form">
                <h1>Cadastrar nova máquina</h1>
                <p>Insira todas as informações abaixo para realizar o cadastro de uma nova máquina</p>
            </div>
            
            <form method="POST">
                <h2>Nome da máquina</h2>
                <input type="text" name="nome_maquina" id="nome_maquina" placeholder="Insira o nome da nova máquina" required>
                <p class="erro"><?php if(isset($result['erros']['nome_maquina'])) {
                    echo $result['erros']['nome_maquina'];
                }?></p>
                <h2>Nome do cliente</h2>
                <select name="id_cliente" id="id_cliente" required>
                    <option value="" selected>Selecione um cliente</option>
                    <?php
                    foreach ($clientes as $cliente) {
                        echo '
                            <option value="' . htmlspecialchars($cliente['id_cliente']) . '">' . htmlspecialchars($cliente['nome']) . '</option>
                        ';
                    }
                    ?>
                </select>
                <h2>Capacidade térmica de refrigeração (BTUs)</h2>
                <input type="text" name="capacidade_termica" id="capacidade_termica" placeholder="Insira a capacidade térmica" required>
                <p class="erro">
                    <?php if (isset($result['erros']['capacidade_termica_de_refrigeracao'])) {
                        echo $result['erros']['capacidade_termica_de_refrigeracao'];
                    }?></p>
                <h2>Localização</h2>
                <input type="text" name="localizacao" id="localizacao" placeholder="Informe a localização" required>
                <p class="erro">
                    <?php if (isset($result['erros']['localizacao'])) {
                        echo $result['erros']['localizacao'];
                    }?></p>
                <h2>Modelo</h2>
                <select name="modelo" id="modelo" required>
                    <option value="" selected>Informe o modelo da máquina</option>
                    <option value="convencional">Convencional</option>
                    <option value="inverter">Inverter</option>
                </select>
                <p class="erro">
                    <?php if (isset($result['erros']['modelo'])) {
                        echo $result['erros']['modelo'];
                    }?></p>
                
                <h2>Marca</h2>
                <input type="text" name="marca" id="marca" placeholder="Informe a marca da máquina" required>
                <p class="erro">
                    <?php if (isset($result['erros']['marca'])) {
                        echo $result['erros']['marca'];
                    }?></p>
                <h2>Fluído Refrigerante</h2>
                <input type="text" name="fluido_refrigerante" id="fluido_refrigerante" placeholder="Informe o fluido refrigerante da máquina" required>
                <p class="erro">
                    <?php if (isset($result['erros']['fluido_refrigerante'])) {
                        echo $result['erros']['fluido_refrigerante'];
                    }?></p>
                <div class="botoes_form">
                    <button class="cancelar">Cancelar</button>
                    <button type="submit" class="cadastrar">Cadastrar</button>
                </div>
            </form>
            
        </div>
        </main>
        <script src="../templates/assets/js/pagina_cadastro_nova_maquina.js"></script>
</body>
</html>