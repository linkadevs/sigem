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
    private $gerenciamentoTec;

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

    public function criarTecnico($nome, $cpf, $funcao, $email, $senha) {
        return $this->gerenciamentoTec->createTec($nome, $cpf, $funcao, $email, $senha);
    }

    public function atualizarTecnico($id, $nome, $cpf, $funcao, $email, $senha) {
        if(!empty($senha)) {
            $senha = password_hash($senha, PASSWORD_DEFAULT);
            return $this->gerenciamentoTec->updateTec($id, $nome, $cpf, $funcao, $email, $senha);
        } else {
            return $this->gerenciamentoTec->updateTecSemSenha($id, $nome, $cpf, $funcao, $email);
        }
    }

    public function excluirTecnico($id_tecnico)
    {

        // VERIFICA SE O ID EXISTE
        if (empty($id_tecnico)) {

            echo "
            <script>
                alert('ID do técnico inválido.');
                window.history.back();
            </script>
            ";

            exit;
        }

        // EXCLUI O TÉCNICO
        $resultado =
            $this->gerenciamentoTec
            ->deleteTec($id_tecnico);

        // VERIFICA RESULTADO
        if ($resultado) {

            echo "
            <script>
                alert('Técnico excluído com sucesso.');

                window.location.href =
                '../View/pagina_gerenciamento_de_tecnicos_adm.php';
            </script>
            ";

        } else {

            echo "
            <script>
                alert('Erro ao excluir técnico.');

                window.history.back();
            </script>
            ";
        }
    }

    // ====================================
    // BUSCAR TÉCNICO POR EMAIL
    // ====================================
    public function buscarTecnicoPorEmail($email)
    {

        // VERIFICA SE O EMAIL EXISTE
        if (empty($email)) {

            return false;
        }

        // RETORNA O RESULTADO
        return $this->gerenciamentoTec
            ->getTecByEmail($email);
    }

    // ====================================
    // BUSCAR TÉCNICO POR FUNÇÃO
    // ====================================
    public function buscarTecnicoPorFuncao($funcao)
    {

        // VERIFICA SE A FUNÇÃO EXISTE
        if (empty($funcao)) {

            return [];
        }

        // RETORNA RESULTADO
        return $this->gerenciamentoTec
            ->getTecByFuncao($funcao);
    }

    // ====================================
    // PESQUISAR TÉCNICOS
    // ====================================
    public function pesquisarTecnicos($busca)
    {

        // SE NÃO EXISTIR PESQUISA
        if (empty($busca)) {

            // RETORNA TODOS
            return $this->gerenciamentoTec
                ->getAllTecs();
        }
        // RETORNA PESQUISA
        return $this->gerenciamentoTec
            ->searchTec($busca);
    }
}

// INSTANCIA O CONTROLLER
$controller =
    new GerenciamentoTecController();

// AÇÃO EXCLUIR
if (isset($_GET['acao'])) {

    // RECEBE A AÇÃO
    $acao = $_GET['acao'];

    // VERIFICA SE É EXCLUIR
    if ($acao == 'excluir') {

        // RECEBE O ID
        $id_tecnico =
            $_GET['id_tecnico'] ?? null;

        // CHAMA A FUNÇÃO
        $controller->excluirTecnico(
            $id_tecnico
        );
    }
}