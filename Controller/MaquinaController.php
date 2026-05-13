<?php

namespace Controller;

use Exception;
use Model\Maquina;

require_once __DIR__ . '/../Model/Maquina.php';

class MaquinaController {
    private Maquina $maquinaModel;

    public function __construct () {
        $this->maquinaModel = new Maquina(); 
    }

    public function criarMaquina(
        string $nome_maquina,
        string $localizacao,
        string $marca,
        string $modelo,
        string $fluido_refrigerante,
        string $capacidade_termica_de_refrigeracao,
        int $id_cliente_fk
    ) {
        try {
            // Criação do código da máquina

            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            do {
                $cod_maquina = '';
                for ($i = 0; $i < 4; $i++) {
                    $cod_maquina .= $chars[random_int(0, strlen($chars) - 1)];
                }
            } while ($this->maquinaModel->verMaquinaPorCodigo($cod_maquina));
            
            // Sanitização (Nesse caso estamos apenas removendo espaços desnecessários, ex: '    Diogo Maia    ' => 'Diogo Maia')
    
            $cod_maquina = trim($cod_maquina);
            $nome_maquina = trim($nome_maquina);
            $localizacao = trim($localizacao);
            $marca = trim($marca);
            $modelo = trim($modelo);
            $fluido_refrigerante = trim($fluido_refrigerante);
    
            // Validação
            $erros = [];
    
            if ($cod_maquina === null || $cod_maquina === '') {
                $erros['cod_maquina'] = 'Erro interno, por favor, recarregue a página e tente novamente.';
            }
    
            if ($nome_maquina === null || $nome_maquina === '') {
                $erros['nome_maquina'] = 'Insira o nome da máquina';
            }
    
            if ($localizacao === null || $localizacao === '') {
                $erros['localizacao'] = 'Insira a localizacao';
            }
    
            if ($marca === null || $marca === '') {
                $erros['marca'] = 'Insira a marca';
            }
    
            if ($modelo === null || $modelo === '') {
                $erros['modelo'] = 'Insira o modelo';
            }
    
            if ($fluido_refrigerante === null || $fluido_refrigerante === '') {
                $erros['fluido_refrigerante'] = 'Insira o fluido refrigerante';
            }
    
            if (filter_var($capacidade_termica_de_refrigeracao, FILTER_VALIDATE_INT) === false) {
                $erros['capacidade_termica_de_refrigeracao'] = 'Capacidade térmica inválida';
                if (empty($capacidade_termica_de_refrigeracao)) {
                    $erros['capacidade_termica_de_refrigeracao'] = 'Insira a capacidade térmica';
                }
            }
    
            if (filter_var($id_cliente_fk, FILTER_VALIDATE_INT) === false) {
                $erros['id_cliente_fk'] = 'Erro interno, por favor, recarregue a página e tente novamente.';
            }
    
            // No fim, a array $erros vai conter cada erro identificado.
    
            // Se tiver erro o código para e retorna uma array com o erro e 'sucesso' = falso
    
            if (!empty($erros)){
                return [
                    'sucesso' => false,
                    'erros' => $erros
                ];
            }
    
            // Salvar no banco de dados
    
            $this->maquinaModel->criarMaquina(
                $cod_maquina,
                $nome_maquina,
                $localizacao,
                $marca,
                $modelo,
                $fluido_refrigerante,
                $capacidade_termica_de_refrigeracao,
                $id_cliente_fk
            );
    
            return [
                'sucesso' => true
            ];
        } catch (Exception $e) {
            throw new Exception('Erro interno grave, por favor, reinicie a página e tente novamente ' . $e);
        }
    }

    public function editarMaquina (
        string $cod_maquina,
        string $nome_maquina,
        string $localizacao,
        string $marca,
        string $modelo,
        string $fluido_refrigerante,
        int $capacidade_termica_de_refrigeracao
    ) {
        try {
            // Sanitização
    
            $cod_maquina = trim($cod_maquina);
            $nome_maquina = trim($nome_maquina);
            $localizacao = trim($localizacao);
            $marca = trim($marca);
            $modelo = trim($modelo);
            $fluido_refrigerante = trim($fluido_refrigerante);
    
            // Validação
    
            $erros = [];
    
            if (empty($cod_maquina)) {
                $erros['cod_maquina'] = 'Erro interno, por favor, recarregue a página e tente novamente.';
            }
    
            if (empty($nome_maquina)) {
                $erros['nome_maquina'] = 'Insira o nome da máquina';
            }
    
            if (empty($localizacao)) {
                $erros['localizacao'] = 'Insira a localizacao';
            }
    
            if (empty($marca)) {
                $erros['marca'] = 'Insira a marca';
            }
    
            if (empty($modelo)) {
                $erros['modelo'] = 'Insira o modelo';
            }
    
            if (empty($fluido_refrigerante)) {
                $erros['fluido_refrigerante'] = 'Insira o fluido refrigerante';
            }
    
            if (filter_var($capacidade_termica_de_refrigeracao, FILTER_VALIDATE_INT) === false) {
                $erros['capacidade_termica_de_refrigeracao'] = 'Capacidade térmica inválida';
                if (empty($capacidade_termica_de_refrigeracao)) {
                    $erros['capacidade_termica_de_refrigeracao'] = 'Insira a capacidade térmica';
                }
            }
    
            if (!empty($erros)){
                return [
                    'sucesso' => false,
                    'erros' => $erros
                ];
            }
    
            $this->maquinaModel->editarMaquina(
                $cod_maquina,
                $nome_maquina,
                $localizacao,
                $marca,
                $modelo,
                $fluido_refrigerante,
                $capacidade_termica_de_refrigeracao
            );
    
            return [
                'sucesso' => true
            ];
        } catch (Exception $e) {
            throw new Exception ('Erro interno grave, por favor, reinicie a página e tente novamente');
        }
    }

    public function deletarMaquina (
        string $cod_maquina
    ) {
        try {
            // Sanitização
    
            $cod_maquina = trim($cod_maquina);
    
            // Validação
    
            $erros = [];
    
            if (empty($cod_maquina)) {
                $erros['cod_maquina'] = 'Erro interno, por favor, recarregue a página e tente novamente.';
            }
    
            if (!empty($erros)) {
                return [
                    'sucesso' => false,
                    'erros' => $erros
                ];
            }
    
            $this->maquinaModel->deletarMaquina($cod_maquina);
    
            return [
                'sucesso' => true
            ];
        } catch (Exception $e) {
            throw new Exception('Erro interno grave, por favor, reinicie a página e tente novamente');
        }
    }

    public function verMaquinas () {
        try {
            return $this->maquinaModel->verMaquinas();
        } catch (Exception $e) {
            throw new Exception('Erro interno grave, por favor, reinicie a página e tente novamente');
        }
    }

    public function verMaquinasPorCliente (
        int $id_cliente_fk
    ) {
        try {
            // Validação
            
            $erros = [];

            if (!filter_var($id_cliente_fk, FILTER_VALIDATE_INT)) {
                $erros['id_cliente_fk'] = 'Erro interno, por favor, recarregue a página e tente novamente';
            }
            
            if (!empty($erros)) {
                return [
                    'sucesso' => false,
                    'erros' => $erros
                ];
            }

            $dados = $this->maquinaModel->verMaquinasPorCliente(
                $id_cliente_fk
            );

            return [
                'sucesso' => true,
                'dados' => $dados
            ];
        } catch (Exception $e) {
            throw new Exception('Erro interno grave, por favor, reinicie a página e tente novamente');
        }
    }
}

?>