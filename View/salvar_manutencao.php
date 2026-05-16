<?php

require_once __DIR__ . '/../Model/Connection.php';
use Model\Connection;

$conn = Connection::getInstance();

// Configuração da pasta de upload
$pasta_upload = __DIR__ . '/../uploads/manutencoes/';

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
            $caminho_relativo = 'uploads/manutencoes/' . $nome_unico;
            $caminho_completo = $pasta_upload . $nome_unico;
            
            if (move_uploaded_file($_FILES['fotos']['tmp_name'][$i], $caminho_completo)) {
                $caminhos_fotos[] = $caminho_relativo;
            }
        }
    }
}

// Converter array de fotos para JSON
$fotos_json = json_encode($caminhos_fotos);

// Salvar no banco
$sql = "INSERT INTO manutencao (tipo_de_servico, descricao_do_servico, acompanhante, pressao_aferida, testes_e_finalizacao, cod_maquina_fk, id_tecnico_fk, fotos) 
        VALUES (:tipo, :descricao, :acompanhante, :pressao, :testes, :cod_maquina, :id_tecnico, :fotos)";

$stmt = $conn->prepare($sql);
$stmt->execute([
    ':tipo' => $_POST['tipo_de_servico'],
    ':descricao' => $_POST['descricao_do_servico'],
    ':acompanhante' => $_POST['acompanhante'],
    ':pressao' => $_POST['pressao_aferida'],
    ':testes' => $_POST['testes_e_finalizacao'],
    ':cod_maquina' => $_POST['cod_maquina'],
    ':id_tecnico' => $_POST['id_tecnico'],
    ':fotos' => $fotos_json
]);

$id_manutencao = $conn->lastInsertId();

echo "Manutenção salva com " . count($caminhos_fotos) . " fotos!";
echo "<br><a href='pagina_visualizacao_pmoc.php?id_manutencao=$id_manutencao&cod_maquina={$_POST['cod_maquina']}&id_tecnico={$_POST['id_tecnico']}'>Ver manutenção</a>";
?>