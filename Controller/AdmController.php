<?php
namespace Controller;

use Model\Adm;
use Model\Administrador;
use PDO;
use PDOException;
use Exception;

class AdmController{
    private $AdmModel;

    public function __construct(){
        $this-> AdmModel = new Administrador();
    }

    public function updateAdm($nome_adm, $cpf_adm, $email_adm, $id_adm) {
        $success = $this->AdmModel->updateUserAdm($nome_adm, $cpf_adm, $email_adm, $id_adm);
    
        if ($success) {
            $_SESSION['nome_adm'] = $nome_adm;
            $_SESSION['email_adm'] = $email_adm;
            $_SESSION['cpf_adm'] = $cpf_adm;
            $_SESSION['success_message'] = "Perfil atualizado com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao atualizar o perfil.";
        }
        header('Location: perfil_do_adm.php');
        exit;
    }

    public function updatePassword($id_adm, $nova_senha, $confirmar_senha){
        if (empty($id_adm) || empty($nova_senha) || empty($confirmar_senha)) {
            $_SESSION['error_message'] = "Todos os campos de senha são obrigatórios.";
            return false;
        }
        if ($nova_senha !== $confirmar_senha) {
            $_SESSION['error_message'] = "As senhas não coincidem.";
            return false;
        }

        $success = $this->AdmModel->changePassword($nova_senha, $id_adm);

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
