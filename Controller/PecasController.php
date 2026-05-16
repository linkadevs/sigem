<?php
namespace Controller;

require_once __DIR__ . '/../Model/PecasModel.php';

use Model\PecasModel;
use Exception;

class PecasController
{
    private $pecasModel;

    public function __construct()
    {
        $this->pecasModel = new PecasModel();
    }

    public function tecnico_nome($id_tecnico)
    {
        try {
            return $this->pecasModel->tecnico_nome($id_tecnico);
        } catch (Exception $e) {
            throw new Exception("Erro ao obter o nome do técnico: " . $e->getMessage());
        }
    }

    public function solicitarPeca($nome_peca, $descricao, $id_tecnico, $status)
    {
        try {
            return $this->pecasModel->solicitarPeca($nome_peca, $descricao, $id_tecnico, $status);
        } catch (Exception $e) {
            throw new Exception("Erro ao solicitar peça: " . $e->getMessage());
        }
    }
}
?>