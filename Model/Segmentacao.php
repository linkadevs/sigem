<?php

namespace Model;
require_once __DIR__ . '/Connection.php';

use PDO;
use PDOException;
use Exception;
use Model\Connection;



class Segmentacao
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function verificar_usuarios($cpf_cnpj, $senha)
    {
        try {
            // Verifica técnico
            
            $sql = "SELECT id_tecnico as id, nome, senha, 'tecnico' as tipo
            FROM tecnico
            WHERE   cpf = :cpf";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':cpf', $cpf_cnpj, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                return [
                    'id' => $usuario['id'],
                    'nome' => $usuario['nome'],
                    'tipo' => $usuario['tipo']
                ];
            }


            // Verifica cliente
            $sql = "SELECT id_cliente as id, nome, senha, 'cliente' as tipo
             FROM cliente
             WHERE cnpj = :cnpj";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':cnpj', $cpf_cnpj, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                return [
                    'id' => $usuario['id'],
                    'nome' => $usuario['nome'],
                    'tipo' => $usuario['tipo']
                ];
            }

            // verifica administrador
            $sql = "SELECT id_administrador as id, nome, senha, 'administrador' as tipo
             FROM administrador
             WHERE cpf = :cpf";
             $stmt = $this->db->prepare($sql);
             $stmt->bindParam(":cpf", $cpf_cnpj, PDO::PARAM_STR);
             $stmt->execute();
             $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($senha, $usuario['senha'])) {
                return [
                    'id' => $usuario['id'],
                    'nome' => $usuario['nome'],
                    'tipo' => $usuario['tipo']
                ];
            } else {
                return null;
            }


        } catch (Exception $erro) {

            throw new Exception("Erro ao validar usuário:" . $erro->getMessage());
        }
    }
}



?>