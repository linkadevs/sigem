<?php

namespace Controller;
require_once __DIR__ . '/../Model/Pmoc.php';

use Exception;
use Model\Pmoc;


class PmocController
{
    private $pmocmodel;

    public function __construct()
    {
        $this->pmocmodel = new Pmoc();
    }


    public function exibir_dadosmaquina($cod_maquina)
    {
        try {
            if (empty($cod_maquina)) {
                return null;
            }

            return $this->pmocmodel->dadosmaquina($cod_maquina);

        } catch (Exception $erro) {
            throw new Exception('Erro ao consultar informações da máquina' . $erro->getMessage());
        }
    }

    public function exibir_dadosmanutencao($cod_maquina, $id_manutencao)
    {
        try {
            if (empty($cod_maquina) || empty($id_manutencao)) {
                return null;
            }

            return $this->pmocmodel->dadosmanutencao($cod_maquina, $id_manutencao);

        } catch (Exception $erro) {
            throw new Exception('Erro ao consultar informações da manutenção' . $erro->getMessage());
        }
    }

    public function exibir_dadostecnico($id_tecnico)
    {
        try {
            if (empty($id_tecnico)) {
                return null;
            }

            return $this->pmocmodel->dadostecnico($id_tecnico);

        } catch (Exception $erro) {
            throw new Exception('Erro ao consultar informações do técnico' . $erro->getMessage());
        }
    }
}




?>