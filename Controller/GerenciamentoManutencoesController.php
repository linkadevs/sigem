<?php

namespace Controller;

require_once __DIR__ ."/../Model/gerenciamentoManutencoes.php";

use Model\GerenciamentoManutencoes;
use Exception;


class GerenciamentoManutencoesController{

    private $GerenciamentoManutencoes;

    public function __construct(){
        $this->GerenciamentoManutencoes = new GerenciamentoManutencoes();
    
    }


    public function exibirmanutencoes($busca = null){
        try{
            $manutencoes = $this->GerenciamentoManutencoes->exibirmanutencoes($busca);
            return $manutencoes;

        }catch(Exception $e){
            return ['erro' => $e->getMessage()];
        }
    }
}

?>