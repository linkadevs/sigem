<?php

namespace Controller;

require_once __DIR__ . '/../Model/Paginainicial.php';

use Model\PaginainicialModel;
use Exception;

class PaginainicialController
{
    private $manutencaoModel;

    public function __construct()
    {
        $this->manutencaoModel = new PaginainicialModel();
    }
    
    public function consultar_ultima_manutencao($cod_maquina_fk)
    {
        try {
            if (empty($cod_maquina_fk)) {
                return null;
            }
            
            return $this->manutencaoModel->consultar_ultima_manutencao($cod_maquina_fk);
            
        } catch (Exception $erro) {
            throw new Exception('Erro ao consultar última manutenção: ' . $erro->getMessage());
        }
    }
}

?>