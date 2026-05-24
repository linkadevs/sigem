<?php

namespace Controller;

require_once __DIR__ . '/../Model/Pecas.php';

use Model\Pecas;
use Exception;

class PecasController
{
    private $pecasmodel;

    public function __construct()
    {
        $this->pecasmodel = new Pecas();
    }

    // LISTAR SOLICITAÇÕES
    public function listarSolicitacoes()
    {
        return $this->pecasmodel->getAllSolicitacoes();
    }

    // BUSCAR POR ID
    public function buscarSolicitacaoPorId($id_solicitacao_pecas)
    {
        if (empty($id_solicitacao_pecas)) {

            return null;
        }

        return $this->pecasmodel
            ->getSolicitacaoById($id_solicitacao_pecas);
    }

    // PESQUISAR SOLICITAÇÕES
    public function pesquisarSolicitacoes($busca)
    {
        if (empty($busca)) {

            return $this->pecasmodel
                ->getAllSolicitacoes();
        }

        return $this->pecasmodel
            ->searchSolicitacao($busca);
    }

    // EXCLUIR SOLICITAÇÃO
    public function excluirSolicitacao($id_solicitacao_pecas)
    {
        if (empty($id_solicitacao_pecas)) {

            echo "
            <script>
                alert('ID da solicitação inválido.');
                window.history.back();
            </script>
            ";

            exit;
        }

        $resultado = $this->pecasmodel
            ->deleteSolicitacao($id_solicitacao_pecas);

        if ($resultado) {

            echo "
            <script>
                alert('Solicitação excluída com sucesso.');

                window.location.href =
                '../View/pagina_gerenciamento_de_pecas_administrador.php';
            </script>
            ";

        } else {

            echo "
            <script>
                alert('Erro ao excluir solicitação.');
                window.history.back();
            </script>
            ";
        }
    }

    // CONCLUIR SOLICITAÇÃO
    public function concluirSolicitacao($id_solicitacao_pecas)
    {
        if (empty($id_solicitacao_pecas)) {

            echo "
            <script>
                alert('ID da solicitação inválido.');
                window.history.back();
            </script>
            ";

            exit;
        }

        $resultado = $this->pecasmodel
            ->concluirSolicitacao($id_solicitacao_pecas);

        if ($resultado) {

            echo "
            <script>
                alert('Solicitação concluída com sucesso.');

                window.location.href =
                '../View/pagina_gerenciamento_de_pecas_administrador.php';
            </script>
            ";

        } else {

            echo "
            <script>
                alert('Erro ao concluir solicitação.');
                window.history.back();
            </script>
            ";
        }
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

// INSTANCIA O CONTROLLER
$controller = new PecasController();

// VERIFICA AÇÕES
if (isset($_GET['acao'])) {

    $acao = $_GET['acao'];

    $id_solicitacao_pecas =
        $_GET['id_solicitacao_pecas'] ?? null;

    // EXCLUIR
    if ($acao == 'excluir') {

        $controller->excluirSolicitacao(
            $id_solicitacao_pecas
        );
    }

    // CONCLUIR
    if ($acao == 'concluir') {

        $controller->concluirSolicitacao(
            $id_solicitacao_pecas
        );
    }
}

?>