<?php
namespace Microblog;
use PDO, Exception;

abstract class Banco {
    private static string $servidor = "localhost";
    private static string $usuario = "root";
    private static string $senha = "";
    private static string $banco = "microblog_tanaka";
    
    // Operador (?) "nullable typeint" (PHP +7.1) 
    // ele indica que a propriedade da classe(conexão) pode ser nulo ou do tipo PDO
    private static ?PDO $conexao = null; 

    public static function conecta():PDO {
        // Condicional para saber se existe uma conexão
        if(self::$conexao === null){
            try {
                self::$conexao = new PDO(
                    "mysql:host=".self::$servidor."; 
                    dbname=".self::$banco.";
                    charset=utf8",
                    self::$usuario, 
                    self::$senha
                );
                self::$conexao->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $erro) {
                die("Deu ruim: ".$erro->getMessage());
            }
        }
        return self::$conexao;
    }
}