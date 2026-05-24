<?php
namespace Controller;
require_once __DIR__ . '/../Model/Historico.php';

use Model\Historico;
use Exception;

class HistoricoController
{
    private $historicoModel;

    public function __construct(){
        $this->historicoModel = new Historico();
    }

    public function obterHistorico($cod_maquina){
        try{
            $historico_infor = $this->historicoModel->Obterhistorico($cod_maquina);
            return $historico_infor;

        }catch(Exception $e){
            throw new Exception("Erro ao obter histórico: " . $e->getMessage());
        }
    }

    public function barra_de_Pesquisa($cod_maquina, $filtro){
        if(empty($filtro)){
        return $this->historicoModel->Obterhistorico($cod_maquina);
        }
        return $this->historicoModel->barra_de_Pesquisa($cod_maquina, $filtro);
    }
}



?>