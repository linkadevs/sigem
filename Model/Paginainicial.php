<?php

namespace Model;

use Exception;
use Model\Connection;
use PDO;
use PDOException;

class Manutencao{
    private $db;
    public function __construct(){
        $this -> db = Connection::getinstance();
    }

    public function consultarmanutencao( $cod_maquina_fk){
        
    }
}

?>