<?php
namespace Controller;

use Model\Tecnico;
use PDO;
use PDOException;
use Exception;

class TecnicoController{
    private $TecnicoModel;

    public function __construct(){
        $this-> TecnicoModel = new Cliente();
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

        $success = $this->ClienteModel->updatePassword($id_tecnico, $nova_senha);

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