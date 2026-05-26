<?php

namespace Controller;
require_once __DIR__ . "/../Model/Segmentacao.php";

use Model\Segmentacao;
use Exception;


class SegmentacaoController
{
    private $segmentacaoModel;

    public function __construct()
    {
        $this->segmentacaoModel = new Segmentacao();
    }


    public function Autenticar_e_validar($cpf_cnpj, $senha, $objetivo, $cod_maquina)
    {
        try {
            $usuario = $this->segmentacaoModel->verificar_usuarios($cpf_cnpj, $senha);

            if (!$usuario) {
                return ['erro' => 'CPF/CNPJ ou senha invalidos!'];
            }

            $redirecionamento = $this->validarAcesso($objetivo, $usuario['tipo'], $cod_maquina, $usuario['id']);

            if (!$redirecionamento) {
                return ['erro' => 'Você não tem permissão para acessar esta funcionalidade!'];
            }

            return [
                'sucesso' => true,
                'redirecionamento' => $redirecionamento,
                'usuario' => $usuario
            ];
        } catch (Exception $e) {
            throw new Exception("Erro ao autenticar e validar: " . $e->getMessage());
        }
    }

    public function validarAcesso($objetivo, $tipo_usuario, $cod_maquina, $id_usuario )
    {
        try {
            switch ($objetivo) {
                case 1:
                    if ($tipo_usuario === 'tecnico' || $tipo_usuario === 'cliente') {
                        return '../View/historico_cet_manutencoes.php?cod_maquina=' . urlencode($cod_maquina);
                    } else if ($tipo_usuario === 'administrador') {
                        return '../View/historico_adm_manutencoes.php?cod_maquina=' . urlencode($cod_maquina);
                    }
                    return null;

                case 2:
                    if ($tipo_usuario === 'tecnico') {
                        return '../View/registro_nova_manutencao.php?cod_maquina=' . urlencode($cod_maquina) . '&id_usuario=' . urlencode($id_usuario);
                    }
                    return null;

                case 3:
                    if ($tipo_usuario === 'cliente') {
                        return '../View/pagina_abertura_chamados.php?cod_maquina=' . urlencode($cod_maquina) . '&id_usuario=' . urlencode($id_usuario);
                    }
                    return null;
                
                // JÁ CONTEMPLA O LOGIN SEGMENTADO PARA CADA TIPO DE USUÁRIO E ENVIA O ID DO 
                // USUÁRIO PARA AS PÁGINAS PRINCIPAIS DE CADA TIPO DE USUÁRIO, PARA QUE SEJAM
                //  EXIBIDOS APENAS OS DADOS RELACIONADOS A ELE.
                case 4:

                if($tipo_usuario === 'cliente'){
                    return '../View/pagina_principal_cliente.php?id_cliente='.urlencode($id_usuario);

                } elseif($tipo_usuario === 'tecnico'){
                    return '../View/pagina_principal_do_tecnico.php?id_tecnico='.urlencode($id_usuario);

                } elseif($tipo_usuario === 'administrador'){
                    return '../View/pagina_principal_adm.php?id_administrador='.urlencode($id_usuario);

                } else {
                    return null;
                }

                default:
                    return null;
            }
        } catch (Exception $e) {
            throw new Exception("Erro ao validar acesso!" . $e->getMessage());
        }
    }
}

?>