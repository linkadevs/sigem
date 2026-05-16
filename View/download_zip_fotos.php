<?php
// Arquivo: View/download_zip_fotos.php
require_once __DIR__ . '/../Model/Connection.php';
use Model\Connection;

$conn = Connection::getInstance();
$id_manutencao = $_GET['id_manutencao'] ?? null;

if (!$id_manutencao) {
    die('ID da manutenção não informado');
}

// Buscar os caminhos das fotos
$sql = "SELECT fotos FROM manutencao WHERE id_manutencao = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id_manutencao);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$fotos = json_decode($result['fotos'] ?? '[]', true);

if (empty($fotos)) {
    die('Nenhuma foto encontrada para esta manutenção');
}

// Criar arquivo ZIP
$zip = new ZipArchive();
$zipName = "manutencao_{$id_manutencao}_fotos.zip";
$zipPath = sys_get_temp_dir() . '/' . $zipName;

if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
    $pasta_base = __DIR__ . '/..';
    
    foreach ($fotos as $i => $caminho_relativo) {
        $caminho_completo = $pasta_base . '/' . $caminho_relativo;
        
        if (file_exists($caminho_completo)) {
            $extensao = pathinfo($caminho_completo, PATHINFO_EXTENSION);
            $nome_arquivo = "foto_" . ($i + 1) . "." . $extensao;
            $zip->addFile($caminho_completo, $nome_arquivo);
        }
    }
    
    $zip->close();
    
    // Download do ZIP
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $zipName . '"');
    header('Content-Length: ' . filesize($zipPath));
    header('Cache-Control: private, max-age=0, must-revalidate');
    
    readfile($zipPath);
    unlink($zipPath);
    exit;
} else {
    die('Erro ao criar arquivo ZIP');
}
?>