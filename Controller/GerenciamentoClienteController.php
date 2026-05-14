<?php

// DEFINE O NAMESPACE
namespace Controller;

// IMPORTA O MODEL
require_once __DIR__ . '/../Model/GerenciamentoCliente.php';

// USA O MODEL
use Model\GerenciamentoCliente;

// CLASSE CONTROLLER
class GerenciamentoClienteController
{

    // ATRIBUTO PRIVADO
    private $gerenciamentoC;

    // CONSTRUTOR
    public function __construct()
    {
        // INSTANCIA O MODEL
        $this->gerenciamentoC = new GerenciamentoCliente();
    }

    // LISTAR TODOS OS CLIENTES
    public function listarClientes()
    {
        // RETORNA TODOS OS CLIENTES
        return $this->gerenciamentoC->getAllClientes();
    }

    // BUSCAR CLIENTE POR ID
    public function buscarClientePorId($id_cliente)
    {

        // VERIFICA SE O ID EXISTE
        if (empty($id_cliente)) {

            return null;
        }

        // RETORNA O CLIENTE
        return $this->gerenciamentoC->getClienteById($id_cliente);
    }

    // EXCLUIR CLIENTE
    public function excluirCliente($id_cliente)
    {

        // VERIFICA SE O ID EXISTE
        if (empty($id_cliente)) {

            echo "
            <script>
                alert('ID do cliente inválido.');
                window.history.back();
            </script>
            ";

            exit;
        }

        // EXCLUI O CLIENTE
        $resultado = $this->gerenciamentoC->deleteCliente($id_cliente);

        // VERIFICA RESULTADO
        if ($resultado) {

            echo "
            <script>
                alert('Cliente excluído com sucesso.');

                window.location.href =
                '../View/pagina_gerenciamento_clientes.php';
            </script>
            ";

        } else {

            echo "
            <script>
                alert('Erro ao excluir cliente.');

                window.history.back();
            </script>
            ";
        }
    }


    // PESQUISAR CLIENTES
    public function pesquisarClientes($busca)
    {

        // SE NÃO EXISTIR PESQUISA
        if (empty($busca)) {
            // RETORNA TODOS
            return $this->gerenciamentoC->getAllClientes();
        }
        // RETORNA PESQUISA
        return $this->gerenciamentoC->searchCliente($busca);
    }
}

// INSTANCIA O CONTROLLER
$controller = new GerenciamentoClienteController();

// AÇÃO EXCLUIR
if (isset($_GET['acao'])) {

    // RECEBE A AÇÃO
    $acao = $_GET['acao'];

    // VERIFICA SE É EXCLUIR
    if ($acao == 'excluir') {

        // RECEBE O ID
        $id_cliente = $_GET['id_cliente'] ?? null;

        // CHAMA A FUNÇÃO
        $controller->excluirCliente(
            $id_cliente
        );
    }
}

?>