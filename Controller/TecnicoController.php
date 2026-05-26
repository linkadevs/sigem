<?php
namespace Controller;

use Model\Tecnico;
use PDO;
use PDOException;
use Exception;

class TecnicoController{
    private $TecnicoModel;

    public function __construct(){
        $this-> TecnicoModel = new Tecnico();
    }

    public function updatePassword($id_tecnico, $nova_senha, $confirmar_senha){
        if (empty($id_tecnico) || empty($nova_senha) || empty($confirmar_senha)) {
            $_SESSION['error_message'] = "Todos os campos de senha são obrigatórios.";
            return false;
        }
        if ($nova_senha !== $confirmar_senha) {
            $_SESSION['error_message'] = "As senhas não coincidem.";
            return false;
        }

        $success = $this->TecnicoModel->changePassword($nova_senha, $id_tecnico);

        if (!$success) {
            throw new Exception("Ocorreu um erro ao alterar a senha.");
        }
        $_SESSION['error_message'] = null;
        header('Location: perfil_do_tecnico.php');
        exit;
    }
}
?>