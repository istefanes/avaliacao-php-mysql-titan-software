<?php

class Conexao {

    private static $instancia;

    public static function getInstancia() {

        if ( empty(self::$instancia) ) {
            // Se ainda não estiver conectado, tenta fazer a conexão com o banco

            try {

                $conn = new PDO('mysql:host='.BD_HOST.';dbname='.BD_BANCO, BD_USUARIO, BD_SENHA);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                self::$instancia = $conn;

            } catch(PDOException $e) {

                // Caso não consiga conectar ao banco de dados
                die('<b>FALHA AO CONECTAR AO BANCO DE DADOS:</b> ' . $e->getMessage());
            }
        }

		return self::$instancia;
    }
}

?>