<?php
namespace Controller;

use Model\Adm;
use Model\GerenciamentoTec;
use PDO;
use PDOException;
use Exception;

class AdmController{
    private $AdmModel;
    private $tecnicoModel;

    public function __construct(){
        $this-> AdmModel = new Adm();
        $this->tecnicoModel = new GerenciamentoTec();
    }

    public function selecionarAdmPorId($id_adm) {
        try {
            return $this->AdmModel->selecionarAdmPorId($id_adm);
        } catch (Exception $e) {
            throw new Exception('Erro ao selecionar Adm por ID: ' . $e);
        }
    }

    public function updateAdm($nome_adm, $cpf_adm, $email_adm, $id_adm) {

        if(
            empty($nome_adm) ||
            empty($cpf_adm) ||
            empty($email_adm)
        ) {
            echo '<script>
                    alert("Por favor, preencha todos os campos.");
                    window.history.back();
                </script>';
            exit;
        }

        if (strlen($cpf_adm) !== 11) {
            echo '<script>
                    alert("O CPF deve conter exatamente 11 dígitos. (Insira apenas números)");
                    window.history.back();
                </script>';
            exit;
        }

        // FORMATA O CPF 000.000.000-00
        $cpf_adm = preg_replace(
            "/(\d{3})(\d{3})(\d{3})(\d{2})/",
            "$1.$2.$3-$4",
            $cpf_adm
        );

        if(
            !empty($this->AdmModel->selecionarAdmPorCpf($cpf_adm)) ||
            !empty($this->tecnicoModel->getTecByCpf($cpf_adm))
        ) {
            $error_message = urlencode("Erro: já existe usuário com esse CPF.");
            header("Location: ../View/perfil_do_adm.php?error_message=$error_message");
            exit;
        }

        $success = $this->AdmModel->updateUserAdm($nome_adm, $cpf_adm, $email_adm, $id_adm);
        if ($success) {
            $_SESSION['nome_adm'] = $nome_adm;
            $_SESSION['email_adm'] = $email_adm;
            $_SESSION['cpf_adm'] = $cpf_adm;
            $_SESSION['success_message'] = "Perfil atualizado com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao atualizar o perfil.";
        }
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
    }
}
?>
