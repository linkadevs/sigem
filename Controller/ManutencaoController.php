<?php
namespace Controller;

require_once __DIR__ . '/../Model/ManutencaoModel.php';

use Model\ManutencaoModel;
use Exception;

class ManutencaoController
{
    private $manutencaoModel;

    public function __construct()
    {
        $this->manutencaoModel = new ManutencaoModel();
    }

    public function salvarManutencao($dados, $fotos)
    {
        try {
            $caminhos_fotos = $this->processarFotos($fotos);
            
            if (empty($caminhos_fotos)) {
                return ['erro' => 'Nenhuma foto válida foi enviada.'];
            }
            
            $fotos_json = json_encode($caminhos_fotos);
            $id_manutencao = $this->manutencaoModel->salvarManutencao($dados, $fotos_json);
            
            return [
                'sucesso' => true,
                'id_manutencao' => $id_manutencao
            ];
            
        } catch (Exception $e) {
            return ['erro' => $e->getMessage()];
        }
    }

    private function processarFotos($fotos)
    {
        $pasta_upload = __DIR__ . '/../uploads/manutencoes/';
        if (!is_dir($pasta_upload)) {
            mkdir($pasta_upload, 0777, true);
        }
        
        $caminhos_fotos = [];
        $total_fotos = count($fotos['name']);
        $total_fotos = min($total_fotos, 10);
        
        for ($i = 0; $i < $total_fotos; $i++) {
            if ($fotos['error'][$i] === UPLOAD_ERR_OK) {
                $extensao = strtolower(pathinfo($fotos['name'][$i], PATHINFO_EXTENSION));
                $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                
                if (!in_array($extensao, $extensoes_permitidas)) {
                    continue;
                }
                
                $nome_unico = uniqid() . '_' . time() . '.' . $extensao;
                $caminho_relativo = 'uploads/manutencoes/' . $nome_unico;
                $caminho_completo = $pasta_upload . $nome_unico;
                
                if (move_uploaded_file($fotos['tmp_name'][$i], $caminho_completo)) {
                    $caminhos_fotos[] = $caminho_relativo;
                }
            }
        }
        
        return $caminhos_fotos;
    }
}
?>