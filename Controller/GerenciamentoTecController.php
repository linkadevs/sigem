<?php

// DEFINE O NAMESPACE
namespace Controller;

// IMPORTA O MODEL
require_once __DIR__ . '/../Model/GerenciamentoTec.php';

// USA O MODEL
use Model\GerenciamentoTec;

// CLASSE CONTROLLER
class GerenciamentoTecController
{

    // ATRIBUTO PRIVADO
    private $gerenciamentoTec;

    // CONSTRUTOR
    public function __construct()
    {

        // INSTANCIA O MODEL
        $this->gerenciamentoTec =
            new GerenciamentoTec();
    }

    // ====================================
    // LISTAR TODOS OS TÉCNICOS
    // ====================================
    public function listarTecnicos()
    {

        // RETORNA TODOS OS TÉCNICOS
        return $this->gerenciamentoTec
            ->getAllTecs();
    }

    // ====================================
    // BUSCAR TÉCNICO POR ID
    // ====================================
    public function buscarTecnicoPorId($id_tecnico)
    {

        // VERIFICA SE O ID EXISTE
        if (empty($id_tecnico)) {

            return null;
        }

        // RETORNA O TÉCNICO
        return $this->gerenciamentoTec
            ->getTecById($id_tecnico);
    }

    // ====================================
    // EXCLUIR TÉCNICO
    // ====================================
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

?>