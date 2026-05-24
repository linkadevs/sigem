<?php

session_start();

require_once __DIR__ . '/../Controller/ChamadoController.php';
require_once __DIR__ . '/../vendor/autoload.php';
use Controller\ChamadoController;

$chamadoController = new ChamadoController();

// Configuração da pasta de upload
$pasta_upload = __DIR__ . '/../uploads/chamados/';

// Criar pasta se não existir
if (!is_dir($pasta_upload)) {
    mkdir($pasta_upload, 0777, true);
}

// Processar as fotos enviadas
$caminhos_fotos = [];


if (isset($_FILES['fotos']) && !empty($_FILES['fotos']['name'][0])) {
    $total_fotos = count($_FILES['fotos']['name']);
    $total_fotos = min($total_fotos, 10); // Máximo 10 fotos
    
    for ($i = 0; $i < $total_fotos; $i++) {
        if ($_FILES['fotos']['error'][$i] === UPLOAD_ERR_OK) {
            $extensao = pathinfo($_FILES['fotos']['name'][$i], PATHINFO_EXTENSION);
            $nome_unico = uniqid() . '_' . time() . '.' . $extensao;
            $caminho_relativo = 'uploads/chamados/' . $nome_unico;
            $caminho_completo = $pasta_upload . $nome_unico;   
            if (move_uploaded_file($_FILES['fotos']['tmp_name'][$i], $caminho_completo)) {
                $caminhos_fotos[] = $caminho_relativo;
            }
        }
    }
}

// Converter array de fotos para JSON
$fotos_json = json_encode($caminhos_fotos);

$descricao = trim($_POST['descricao'] ?? '');
$cliente = $_SESSION['id_usuario'] ?? '';
$cod_maquina = trim($_SESSION['cod_maquina']) ?? '';

if (
    empty($descricao) ||
    empty($cliente) ||
    empty($cod_maquina)
) {
    die('Preencha todos os campos. ' . $descricao . $cliente . $cod_maquina);
}


// Salvar no banco

$chamadoController->abrirChamado($descricao, $fotos_json, $cliente, $cod_maquina);
header('Location: pagina_acompanhamento_chamados_cliente.php');
exit();
?>