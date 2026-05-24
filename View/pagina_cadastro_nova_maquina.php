<?php

session_start();

use Controller\MaquinaController;
// use Controller\ClienteController;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Controller/MaquinaController.php';
// require_once __DIR__ . '/../Controller/ClienteController.php';

// $clienteController = new ClienteController();
$maquinaController = new MaquinaController();

// $clientes = $clienteController->SelecionarTodosClientes();


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['nome_maquina'] = $_POST['nome_maquina'];
    $_SESSION['localizacao'] = $_POST['localizacao'];
    $_SESSION['marca'] = $_POST['marca'];
    $_SESSION['modelo'] = $_POST['modelo'];
    $_SESSION['fluido_refrigerante'] = $_POST['fluido_refrigerante'];
    $_SESSION['capacidade_termica'] = $_POST['capacidade_termica'];
    $_SESSION['id_cliente'] = $_POST['id_cliente'];
    header('Location: pagina_visualizacao_do_codigo.php');
    exit();
}

if($_SESSION['cod_maquina'] === null) {
    $title = 'Cadastro de máquina';
    $h1 = 'Cadastrar nova máquina';
    $p = 'Insira todas as informações abaixo para realizar o cadastro de uma nova máquina';
    $maquina = ['dados' => ['modelo' => '']];
    $nome_maquina_value = '';
    $capacidade_termica_value = '';
    $localizacao_value = '';
    $modelo_value = '';
    $marca_value = '';
    $fluido_refrigerante_value = '';
} else {
    $cod_maquina = $_SESSION['cod_maquina'];
    $maquina = $maquinaController->verMaquinasPorCodigo($cod_maquina);
    $title = 'Edição da máquina '. htmlspecialchars($cod_maquina);
    $h1 = 'Editar máquina ' . htmlspecialchars($cod_maquina);
    $p = 'Edite todas as informações abaixo para realizar a edição da máquina';
    $nome_maquina_value = $maquina['dados']['nome_maquina'];
    $capacidade_termica_value = $maquina['dados']['capacidade_termica_de_refrigeracao'];
    $localizacao_value = $maquina['dados']['localizacao'];
    $modelo_value = $maquina['dados']['modelo'];
    $marca_value = $maquina['dados']['marca'];
    $fluido_refrigerante_value = $maquina['dados']['fluido_refrigerante'];
    $id_cliente_value = $maquina['dados']['id_cliente_fk'];
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../templates/assets/css/pagina_cadastro_nova_maquina.css">
    <title><?php echo $title;?></title>
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
                <h1><?php echo $h1;?></h1>
                <p><?php echo $p;?></p>
            </div>
            
            <form method="POST">
                <h2>Nome da máquina</h2>
                <input value="<?php echo $nome_maquina_value;?>" type="text" name="nome_maquina" id="nome_maquina" placeholder="Insira o nome da nova máquina" required>
                <p class="erro"><?php if(isset($result['erros']['nome_maquina'])) {
                    echo htmlspecialchars($result['erros']['nome_maquina']);
                }?></p>
                <h2>Nome do cliente</h2>
                <select name="id_cliente" id="id_cliente" required>
                    <option value="" <?php
                        if($_SESSION['cod_maquina'] === null) {
                            echo 'selected';
                        }
                    ?>>Selecione um cliente</option>
                    <option value="2">SESI</option>
                    <?php
                    foreach ($clientes as $cliente) {
                        echo '
                            <option value="' . htmlspecialchars($cliente['id_cliente']) . ' ';
                            if($id_cliente_value === $cliente['id_cliente']) {
                                echo 'selected';
                            }
                            echo '">' . htmlspecialchars($cliente['nome']) . '</option>
                        ';
                    }
                    ?>
                </select>
                <h2>Capacidade térmica de refrigeração (BTUs)</h2>
                <input value="<?php echo htmlspecialchars($capacidade_termica_value);?>" type="text" name="capacidade_termica" id="capacidade_termica" placeholder="Insira a capacidade térmica" required>
                <p class="erro">
                    <?php if (isset($result['erros']['capacidade_termica_de_refrigeracao'])) {
                        echo htmlspecialchars($result['erros']['capacidade_termica_de_refrigeracao']);
                    }?></p>
                <h2>Localização</h2>
                <input value="<?php echo htmlspecialchars($localizacao_value);?>" type="text" name="localizacao" id="localizacao" placeholder="Informe a localização" required>
                <p class="erro">
                    <?php if (isset($result['erros']['localizacao'])) {
                        echo htmlspecialchars($result['erros']['localizacao']);
                    }?></p>
                <h2>Modelo</h2>
                <select name="modelo" id="modelo" required>
                    <option value="" <?php
                        if($_SESSION['cod_maquina'] === null) {
                            echo 'selected';
                        }
                    ?>>Informe o modelo da máquina</option>
                    <option value="convencional" <?php
                        if($maquina['dados']['modelo'] === 'convencional'){
                            echo 'selected';
                        }
                    ?>>Convencional</option>
                    <option value="inverter" <?php
                        if($maquina['dados']['modelo'] === 'inverter'){
                            echo 'selected';
                        }
                    ?>>Inverter</option>
                </select>
                <p class="erro">
                    <?php if (isset($result['erros']['modelo'])) {
                        echo htmlspecialchars($result['erros']['modelo']);
                    }?></p>
                
                <h2>Marca</h2>
                <input value="<?php echo htmlspecialchars($marca_value);?>" type="text" name="marca" id="marca" placeholder="Informe a marca da máquina" required>
                <p class="erro">
                    <?php if (isset($result['erros']['marca'])) {
                        echo htmlspecialchars($result['erros']['marca']);
                    }?></p>
                <h2>Fluído Refrigerante</h2>
                <input value="<?php echo htmlspecialchars($fluido_refrigerante_value);?>" type="text" name="fluido_refrigerante" id="fluido_refrigerante" placeholder="Informe o fluido refrigerante da máquina" required>
                <p class="erro">
                    <?php if (isset($result['erros']['fluido_refrigerante'])) {
                        echo htmlspecialchars($result['erros']['fluido_refrigerante']);
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