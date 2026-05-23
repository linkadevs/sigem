<?php

// DEFINE O NAMESPACE
namespace Controller;

use Exception;
use PDOException;

// IMPORTA O MODEL
require_once __DIR__ . '/../Model/GerenciamentoCliente.php';

// USA O MODEL
use Model\GerenciamentoCliente;

// CLASSE CONTROLLER
class GerenciamentoClienteController
{

    // ATRIBUTO PRIVADO
    public $gerenciamentoC;

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

    // CRIAR CLIENTE
    public function criarCliente($nome, $cnpj, $uf, $cidade, $contato, $email, $senha)
    {
        return $this->gerenciamentoC->createCliente($nome, $cnpj, $uf, $cidade, $contato, $email, $senha);
    }

    // ATUALIZAR CLIENTE
    public function atualizarCliente($id_cliente, $nome, $cnpj, $uf, $cidade, $contato, $email)
    {
        return $this->gerenciamentoC->updateCliente($id_cliente, $nome, $cnpj, $uf, $cidade, $contato, $email);
    }

    // EXCLUIR CLIENTE
    public function excluirCliente($id_cliente)
    {
        if (empty($id_cliente)) {
            return false;
        }

        return $this->gerenciamentoC->deleteCliente($id_cliente);
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

?>