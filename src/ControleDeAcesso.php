<?php
// Namespace
namespace Microblog;

// Classe
final class ControleDeAcesso {
    // Metodo para iniciar a sessão($_SESSION) via construtor.
    public function __construct(){
        // Se não existir uma sessão em funcionamento ele vai se iniciar com o comando (session_start)
        if(!isset($_SESSION)){
            session_start();
        }
    }

    // Metodo para verificação de acesso
    public function verificaAcesso():void {
        if (!isset($_SESSION['id'])) {
            session_destroy();
            header('location:../login.php');
            die();
        }
    }
}
