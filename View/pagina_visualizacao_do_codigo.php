<?php
session_start();


require_once __DIR__ . '/../vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

use Controller\MaquinaController;
require_once __DIR__ . '/../Controller/MaquinaController.php';
$maquinaController = new MaquinaController();

if($_SESSION['nome_maquina'] === null) {
    header('Location: gerenciamento_de_maquinas_adm.php');
    exit();
}
$cod_maquina = $_SESSION['cod_maquina'];
$nome_maquina = $_SESSION['nome_maquina'];
$localizacao = $_SESSION['localizacao'];
$marca = $_SESSION['marca'];
$modelo = $_SESSION['modelo'];
$fluido_refrigerante = $_SESSION['fluido_refrigerante'];
$capacidade_termica_de_refrigeracao = $_SESSION['capacidade_termica'];
$id_cliente_fk = $_SESSION['id_cliente'];

if(!empty($cod_maquina) && isset($cod_maquina)) {
    $result = $maquinaController->editarMaquina(
        $cod_maquina,
        $nome_maquina,
        $localizacao,
        $marca,
        $modelo,
        $fluido_refrigerante,
        $capacidade_termica_de_refrigeracao
    );
} else {
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


$qrCode = new QrCode($result['dados']);

$writer = new PngWriter();
$resultQr = $writer->write($qrCode);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../templates/assets/css/pagina_visualizacao_do_codigo.css?v=<?= time() ?>">
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
        <div class="card_main">
            <div class="titulo_card">
                <h1>Código da máquina</h1>
                <p>Copie e salve o QR code abaixo da sua nova máquina (Você poderá acessar o código da máquina posteriormente na página de gerenciamento de máquinas)</p>
            </div>
            
            <figure class="qrcode">
                <img src="data:image/png;base64,<?php echo base64_encode($resultQr->getString());?>" alt="QR Code" id="qrCodeImage">
            </figure>
            <div class="codigo_maquina">
                <h1 id="textoParaCopiar"><?php echo htmlspecialchars($result['dados']);?></h1>

                <figure>
                    <img src="../templates/assets/img/copiar.png" alt="Copie Aqui!" id="feedbackIcone" onclick="copiar()">
                    <img src="../templates/assets/img/icone-check.png" alt="Texto copiado!" id="iconeCheck" style="display: none;">
                </figure>
            </div>

            <p class="textoCopiado" style="display: none;  width: 100% ;margin: 0; text-align: center;">Texto Copiado!</p>
            
            <div class="botoes_card">
                <button class="sair">Sair</button>
                <button type="submit" class="salvar" onclick="baixarComTexto()">Salvar QR Code</button>
            </div>
            
        </div>
    </main>
    <script src="../templates/assets/js/pagina_visualizacao_do_codigo.js"></script>
</body>
</html>