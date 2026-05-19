<?php

namespace Controller;

use Exception;
use Model\Chamado;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Model/Chamado.php';

class ChamadoController {
    private Chamado $chamadoModel;

    public function __construct() {
        $this->chamadoModel = new Chamado();
    }

    public function selecionarTodosOsChamados() :array {
        try {
            return $this->chamadoModel->selecionarTodosOsChamados();
        } catch (Exception $e) {
            throw new Exception(
                'Erro ao selecionar todos os chamados.',
                0,
                $e
            );
        }
    }

    public function selecionarChamadosPorCliente (
        int $id_cliente_fk
    ) :array {
        try {
            $id_cliente_fk = filter_var($id_cliente_fk, FILTER_SANITIZE_NUMBER_INT);
            return $this->chamadoModel->selecionarChamadosPorCliente($id_cliente_fk);
        } catch (Exception $e) {
            throw new Exception(
                'Erro ao selecionar chamados do cliente.',
                0,
                $e
            );
        }
    }

    public function selecionarChamadosPorId (
        int $id_chamado
    ) :?array {
        try {
            $id_chamado = filter_var($id_chamado, FILTER_SANITIZE_NUMBER_INT);
            return $this->chamadoModel->selecionarChamadosPorId($id_chamado);
        } catch (Exception $e) {
            throw new Exception(
                'Erro ao selecionar chamados por id.',
                0,
                $e
            );
        }
    }

    public function selecionarChamadosPorTecnico (
        int $id_tecnico_fk
    ) :array {
        try {
            $id_tecnico_fk = filter_var($id_tecnico_fk, FILTER_SANITIZE_NUMBER_INT);
            return $this->chamadoModel->selecionarChamadosPorTecnico($id_tecnico_fk);
        } catch (Exception $e) {
            throw new Exception(
                'Erro ao selecionar chamados por técnico.',
                0,
                $e
            );
        }
    }
    
    public function abrirChamado (
        string $descricao,
        string $status,
        string $fotos,
        int $id_cliente_fk,
        string $cod_maquina_fk
    ) :bool {
        try {
            $descricao = trim($descricao);
            $status = trim($status);
            $fotos = trim($fotos);
            $cod_maquina_fk = trim($cod_maquina_fk);

            $id_cliente_fk = filter_var($id_cliente_fk, FILTER_SANITIZE_NUMBER_INT);
            
            return $this->chamadoModel->abrirChamado(
                $descricao,
                $status,
                $fotos,
                $id_cliente_fk,
                $cod_maquina_fk
            );
        } catch (Exception $e) {
            throw new Exception(
                'Erro ao abrir chamado.',
                0,
                $e
            );
        }
    }

    public function deletarChamado(
        int $id_chamado
    ) :bool {
        try {
            $id_chamado = filter_var($id_chamado, FILTER_SANITIZE_NUMBER_INT);
            return $this->deletarChamado($id_chamado);
        } catch (Exception $e) {
            throw new Exception(
                'Erro ao deletar chamado',
                0,
                $e
            );
        }
    }
}

?>