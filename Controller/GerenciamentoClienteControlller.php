
<?php

namespace Controller;

// IMPORTA O MODEL
require_once __DIR__ . '/../Model/GerenciamentoCliente.php';

// USA O MODEL
use Model\GerenciamentoCliente;

// CLASSE CONTROLLER
class GerenciamentoClienteController
{

    // ATRIBUTO PRIVADO
    private $gerenciamentoCliente;

    // CONSTRUTOR
    public function __construct()
    {

        // INSTANCIA O MODEL
        $this->gerenciamentoCliente =
            new GerenciamentoCliente();
    }

  

    // LISTAR CLIENTES
    public function listarClientes()
    {
        return $this->gerenciamentoCliente->getAllClientes();
    }

    // BUSCAR CLIENTE POR ID
    public function buscarClientePorId($id_cliente)
    {
        return $this->gerenciamentoCliente->getClienteById($id_cliente);
    }

    // EXCLUIR CLIENTE
    public function excluirCliente($id_cliente)
    {
        return $this->gerenciamentoCliente->deleteCLiente($id_cliente);
    }

    // PESQUISAR CLIENTE
    public function pesquisarCliente()
    {
        // pega o valor digitado na barra
        $busca = trim($_GET['busca'] ?? '');

        // se não pesquisar nada → mostra todos os clientes
        if (empty($busca)) {
            return $this->gerenciamentoCliente->getAllClientes();
        }

        // se pesquisar → mostra resultado da pesquisa
        return $this->gerenciamentoCliente->searchCliente($busca);
    }
}

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
        $controller->excluirCliente($id_cliente);
    }
}
?>