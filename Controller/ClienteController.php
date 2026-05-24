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

        $success = $this->ClienteModel->changePassword($id_cliente, $nova_senha);

        if ($success) {
            $_SESSION['success_message'] = "Senha alterada com sucesso!";
        } else {
            $_SESSION['error_message'] = "Ocorreu um erro ao alterar a senha.";
        }
        header('Location: perfil_do_adm.php#content-seguranca');
        exit;
    }
}
?>