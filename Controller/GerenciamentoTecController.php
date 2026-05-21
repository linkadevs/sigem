<?php
namespace Controller;

use Exception;
use PDOException;

// IMPORTA O MODEL
require_once __DIR__ . '/../Model/GerenciamentoTec.php';
use Model\GerenciamentoTec;


// CLASSE CONTROLLER
class GerenciamentoTecController
{
    public $gerenciamentoTec;

    public function __construct() {
        $this->gerenciamentoTec = new GerenciamentoTec();
    }

    public function listarTecnicos() {
        return $this->gerenciamentoTec->getAllTecs();
    }

    public function buscarTecnicoPorId($id_tecnico) {
        if (empty($id_tecnico)) return null;
        return $this->gerenciamentoTec->getTecById($id_tecnico);
    }

    public function excluirTecnico($id_tecnico) {
        if (empty($id_tecnico)) return false;
        return $this->gerenciamentoTec->deleteTec($id_tecnico);
    }

    public function pesquisarTecnicos($busca) {
        return empty($busca) ? $this->gerenciamentoTec->getAllTecs() : $this->gerenciamentoTec->searchTec($busca);
    }
}