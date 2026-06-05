<?php
namespace Controller;

use Model\Cliente;
use PDO;
use PDOException;
use Exception;

class ClienteController{
    private $ClienteModel;

    public function __construct(){
        $this-> ClienteModel = new Cliente();
    }

    public function updatePassword($id_cliente, $nova_senha, $confirmar_senha){
        if (empty($id_cliente) || empty($nova_senha) || empty($confirmar_senha)) {
            $_SESSION['error_message'] = "Todos os campos de senha são obrigatórios.";
            return false;
        }
        if ($nova_senha !== $confirmar_senha) {
            $_SESSION['error_message'] = "As senhas não coincidem.";
            return false;
        }

        $success = $this->ClienteModel->changePassword($nova_senha, $id_cliente);

        if (!$success) {
           throw new Exception("Ocorreu um erro ao alterar a senha.");
        }
        $_SESSION['error_message'] = null;
        header('Location: perfil_cliente.php');
        exit;
    }
}
?>