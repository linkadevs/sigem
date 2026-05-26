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
        string $fotos,
        int $id_cliente_fk,
        string $cod_maquina_fk
    ) :bool {
        try {
            $descricao = trim($descricao);
            $fotos = trim($fotos);
            $cod_maquina_fk = trim($cod_maquina_fk);

            $id_cliente_fk = filter_var($id_cliente_fk, FILTER_SANITIZE_NUMBER_INT);
            
            return $this->chamadoModel->abrirChamado(
                $descricao,
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
            return $this->chamadoModel->deletarChamado($id_chamado);
        } catch (Exception $e) {
            throw new Exception(
                'Erro ao deletar chamado',
                0,
                $e
            );
        }
    }

    public function pesquisarChamado (
        string $pesquisa
    ) :array {
        $pesquisa = trim($pesquisa);
        try {
            return $this->chamadoModel->pesquisarChamado($pesquisa);
        } catch (Exception $e) {
            throw new Exception(
                'Erro ao pesquisar chamado.',
                0,
                $e
            );
        }
    }

    public function pesquisarChamadoCliente (
        string $pesquisa,
        int $id_cliente
    ) :array {
        $pesquisa = trim($pesquisa);
        $id_cliente = filter_var($id_cliente, FILTER_SANITIZE_NUMBER_INT);
        try {
            return $this->chamadoModel->pesquisarChamadoCliente(
                $pesquisa,
                $id_cliente
            );
        } catch (Exception $e) {
            throw new Exception(
                'Erro ao pesquisar chamados.',
                0,
                $e
            );
        }
    }

    public function pesquisarChamadoTecnico (
        string $pesquisa,
        int $id_tecnico
    ) :array {
        $pesquisa = trim($pesquisa);
        $id_tecnico = filter_var($id_tecnico, FILTER_SANITIZE_NUMBER_INT);
        try {
            return $this->chamadoModel->pesquisarChamadoTecnico(
                $pesquisa,
                $id_tecnico
            );
        } catch (Exception $e) {
            throw new Exception(
                'Erro ao pesquisar chamados',
                0,
                $e
            );
        }
    }

    public function responsabilizarse (
        int $id_tecnico,
        int $id_chamado
    ) :bool {
        $id_tecnico = filter_var($id_tecnico, FILTER_SANITIZE_NUMBER_INT);
        $id_chamado = filter_var($id_chamado, FILTER_SANITIZE_NUMBER_INT);
        try {
            return $this->chamadoModel->responsabilizarse(
                $id_tecnico,
                $id_chamado
            );
        } catch (Exception $e) {
            throw new Exception(
                'Erro ao responsabilizar técnico ao chamado.',
                0,
                $e
            );
        }
    }
    
    public function cancelar (
        int $id_chamado
    ) :bool {
        $id_chamado = filter_var($id_chamado, FILTER_SANITIZE_NUMBER_INT);
        try {
            return $this->chamadoModel->cancelar($id_chamado);
        } catch (Exception $e) {
            throw new Exception(
                'Erro ao cancelar responsabilidade do chamado',
                0,
                $e
            );
        }
    }

    public function finalizarChamado (
        int $id_chamado
    ) :bool {
        $id_chamado = filter_var($id_chamado, FILTER_SANITIZE_NUMBER_INT);
        try {
            return $this->chamadoModel->finalizarChamado($id_chamado);
        } catch (Exception $e) {
            throw new Exception(
                'Erro ao finalizar chamado.',
                0,
                $e
            );
        }
    }
}

?>